<?php

class Page {
	var $page;
	function Page($template = 'std.tpl') {
		if (file_exists($template))
			$this->page = join('', file($template));
		else
			die("Template file $template not found.");
		}

	function parse($file) {
		ob_start();
		include($file);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	function replace_tags($tags = array()) {
		if (sizeof($tags) > 0)
			foreach ($tags as $tag => $data) {
				$data = (file_exists($data)) ? $this->parse($data) : $data;
				$this->page = eregi_replace('{' . $tag . '}', $data, $this->page);
			}
		else
			die('No tags designated for replacement.');
		}

	function output() {
		print($this->page);
	}
}
?> 