<?php
define('BASE', './');
require_once(BASE . 'functions/init.inc.php');
require_once(BASE . 'functions/calendar_functions.php');

//require_once(BASE . 'lib/HTTP/WebDAV/Server.php');
require_once('/home/jablko/public_html/gallery2/modules/webdav/lib/HTTP/WebDAV/Server.php');
require_once(BASE . 'lib/HTTP/CalDAV/Server.php');

require_once(BASE . 'lib/bennu/bennu.class.php');
require_once(BASE . 'lib/bennu/iCalendar_components.php');
require_once(BASE . 'lib/bennu/iCalendar_parameters.php');
require_once(BASE . 'lib/bennu/iCalendar_properties.php');
require_once(BASE . 'lib/bennu/iCalendar_rfc2445.php');

class HTTP_CalDAV_Server_PHPiCalendar extends HTTP_CalDAV_Server {
	function getBasePath() {
		global $calendar_path;
		static $basePath;

		if (!isset($basePath)) {
			$basePath = '';
			$pathComponents = explode('/', $calendar_path);
			foreach ($pathComponents as $value) {
				if (!empty($value)) {
					$basePath .= "/$value";
				}
			}

			// Above is nice, but breaks relative base paths like ./calendars
			$basePath = rtrim($calendar_path);
		}

		return $basePath;
	}

	function deletePath($absolutePath) {
		$dirs = array();
		$paths = array();
		while (isset($absolutePath)) {
			if (is_dir($absolutePath)) {
				$handle = opendir($absolutePath);
				if (!$handle) {
					return;
				}

				while (($pathComponent = readdir($handle)) !== false) {
					if ($pathComponent != '.' && $pathComponent != '..') {
						$paths[] = "$absolutePath/$pathComponent";
					}
				}
				closedir($handle);

				$dirs[] = $absolutePath;
			} else {
				unlink($absolutePath);
			}

			$absolutePath = array_pop($paths);
		}

		$absolutePath = array_pop($dirs);
		while (isset($absolutePath)) {
			rmdir($absolutePath);
			$absolutePath = array_pop($dirs);
		}

		return true;
	}

	function delete($options) {
		$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() .  '/' .
			$options['path'];
		if (!file_exists($absolutePath)) {
			return '404 Not Found';
		}

		return HTTP_CalDAV_Server_PHPiCalendar::deletePath($absolutePath);
	}

	function get(&$options) {
		$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() . '/' .
			$options['path'];

		if (!file_exists($absolutePath)) {
			return;
		}

		if (is_file($absolutePath)) {
			$options['mimetype'] = mime_content_type($absolutePath);

			$stat = stat($absolutePath);
			$options['mtime'] = $stat['mtime'];
			$options['size'] = $stat['size'];

			$options['stream'] = fopen($absolutePath, 'r');
		}

		return true;
	}

	function move(&$options) {
		
		// Body parsing not yet supported
		if ($_SERVER['CONTENT_LENGTH']) {
			return '415 Unsupported Media Type';
		}

		// Copying to remote wervers not yet supported
		if (isset($options['dest_url'])) {
			return '502 Bad Gateway';
		}

		$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() . '/' .
			$options['path'];

		if (!file_exists($absolutePath)) {
			return '404 Not Found';
		}

		if (is_dir($absolutePath) && $options['depth'] != 'infinity') {
			return '400 Bad Request';
		}

		$newAbsolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() .
			'/' . $options['dest'];
		if (!is_dir(dirname($newAbsolutePath))) {
			return '409 Conflict';
		}

		if (file_exists($newAbsolutePath)) {
			if (!$options['overwrite']) {
				return '412 Precondition Failed';
			}

			if (!HTTP_CalDAV_Server_PHPiCalendar::deletePath(
					$newAbsolutePath)) {
				return '403 Forbidden';
			}

			$options['new'] = false;
		}

		if (!rename($absolutePath, $newAbsolutePath)) {
			return '403 Forbidden';
		}

		return true;
	}

	// FIXME Use file_exists
	function propfind($options, &$files) {
		$files = array();
		$paths = array(array($options['path'], 0));
		while (!empty($paths)) {
			list ($path, $depth) = array_pop($paths);

			$file = array();
			$file['path'] = $path;

			$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() .
				'/' . $path;
			$stat = stat($absolutePath);
			$file['props'] = array();
			$file['props'][] = $this->mkprop('creationdate', $stat['ctime']);
			$file['props'][] = $this->mkprop('getlastmodified', $stat['mtime']);

			if (is_dir($absolutePath)) {
				$file['props'][] = $this->mkprop('resourcetype', 'collection');

				if ($depth < $options['depth'] ||
						$options['depth'] == 'infinity') {
					$handle = opendir($absolutePath);
					if (!$handle) {
						return;
					}

					while (($pathComponent = readdir($handle)) !== false) {
						if ($pathComponent != '.' && $pathComponent != '..') {
							$paths[] = array($path != '' ?
								"$path/$pathComponent" : $pathComponent,
								$depth + 1);
						}
					}
					closedir($handle);
				}
			} else {
				$file['props'][] = $this->mkprop('getcontentlength',
					$stat['size']);
				$file['props'][] = $this->mkprop('resourcetype', null);
			}

			$files[] = $file;
		}

		return true;
	}

	function put(&$options) {
		$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() . '/' .
			$options['path'];
		if (!is_dir(dirname($absolutePath))) {
			return '409 Conflict';
		}

		$options['new'] = !file_exists($absolutePath);
		$handle = @fopen($absolutePath, 'w');
		if (!$handle) {
			return '403 Forbidden';
		}

		return $handle;
	}

	function report($options, &$files) {
		$files = array();
		$paths = array(array($options['path'], 0));
		while (!empty($paths)) {
			list ($path, $depth) = array_pop($paths);

			$file = array();
			$file['path'] = $path;

			$absolutePath = HTTP_CalDAV_Server_PHPiCalendar::getBasePath() .
				'/' . $path;
			$stat = stat($absolutePath);
			$file['props'] = array();
			$file['props'][] = $this->mkprop('creationdate', $stat['ctime']);
			$file['props'][] = $this->mkprop('getlastmodified', $stat['mtime']);

			if (is_dir($absolutePath)) {
				$file['props'][] = $this->mkprop('resourcetype', 'collection');

				if ($depth < $options['depth'] ||
						$options['depth'] == 'infinity') {
					$handle = opendir($absolutePath);
					if (!$handle) {
						return;
					}

					while (($pathComponent = readdir($handle)) !== false) {
						if ($pathComponent != '.' && $pathComponent != '..') {
							$paths[] = array($path != '' ?
								"$path/$pathComponent" : $pathComponent,
								$depth + 1);
						}
					}
					closedir($handle);
				}
			} else {
				$file['props'][] = $this->mkprop('getcontentlength',
					$stat['size']);
				$file['props'][] = $this->mkprop('resourcetype', null);
			}

			$files[] = $file;
		}

		return true;
	}
}

$server = new HTTP_CalDAV_Server_PHPiCalendar();
$server->ServeRequest();
?>
