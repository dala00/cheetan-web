<?php
	require_once 'Smarty.class.php';
	
	
class CSmartyController extends CController
{
	var $smarty;
	var $viewfile_ext	= ".tpl";
	
	
	function CSmartyController()
	{
		CController::CController();
		$this->smarty					= new Smarty;
		$this->smarty->compile_check	= true;
		$this->smarty->debugging		= true;
	}
	
	
	function set( $key, $value )
	{
		$this->smarty->assign( $key, $value );
	}
}
