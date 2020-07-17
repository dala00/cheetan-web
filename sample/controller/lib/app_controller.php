<?php
class CAppController extends CController {
	var $uses = null;
	var $components = array('html');
	
	
	function is_secure() {
		return true;
	}
	
	function check_secure() {
	}
	
	function config_controller() {
	}
	
	function after_action() {
	}
	
	function after_render() {
	}
	
	function redirect($url, $is301 = FALSE) {
		$url = $this->html->url($url);
		CController::redirect($url, $is301);
	}
}