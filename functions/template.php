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
				
				// This opens up another template and parses it as well.
				$data = (file_exists($data)) ? $this->parse($data) : $data;
				
				// This removes any unfilled tags
				if ($data == '') {
					$this->page = eregi_replace('<!-- switch ' . $tag . ' on -->(.*)<!-- switch ' . $tag . ' off -->', '', $this->page);
				}
				
				// This replaces any tags
				$this->page = eregi_replace('{' . $tag . '}', $data, $this->page);
			}
		else
			die('No tags designated for replacement.');
		}
	
	function replace_langs($langs = array()) {
		foreach ($langs as $tag => $data) {
			$this->page = eregi_replace('{' . $tag . '}', $data, $this->page);
		}
	}
	
	function output() {
		print($this->page);
	}
}
?> 