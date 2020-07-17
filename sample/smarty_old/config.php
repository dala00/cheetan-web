<?php
	$old_ini = ini_get( 'include_path' );
	ini_set( 'include_path', $old_ini . ':/home/alphabrend/smarty');
	
function config_controller_class()
{
	require_once( 'smarty_controller.php' );
	return 'CSmartyController';
}


function after_action( &$c )
{
	$file	= $c->GetViewFile();
	$c->smarty->display( $file );
	exit();
}