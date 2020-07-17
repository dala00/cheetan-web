<?php
class CHtml extends CObject {

	function url($url) {
		if (strpos($url, '://')) {
			return $url;
		}
		$base = $_SERVER['REQUEST_URI'];
		if ($_GET['url']) {
			$pos = strpos($base, $_GET['url']);
			$base = substr($base, 0, $pos);
		}
		$len = strlen($base);
		if ($url[0] == '/') {
			if ($base[$len - 1] == '/') {
				$base = substr($base, 0, $len - 1);
			}
		} else {
			if ($base[$len - 1] != '/') {
				$base .=  '/';
			}
		}
		$url = $base . $url;
		
		return $url;
	}
}
