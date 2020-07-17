<?php
ini_set( 'include_dir', '.:/home/user/smarty/' );


function config_database( &$db )
{
	$db->add( "", "host", "user", "password", "db" );
}


function config_models( &$controller )
{
	$controller->AddModel( dirname(__FILE__) . "/models/blog_data.php" );
}


function config_controller( &$controller )
{
	$controller->SetTemplateFile( "template.tpl" );
}


function config_controller_class()
{
	require_once( 'smarty_controller.php' );
	return 'CSmartyController';
}


function config_view_class()
{
	require_once( 'smarty_view.php' );
	return 'CSmartyView' ;
}


function InitTime( $time )
{
	$year	= substr( $time, 0, 4 );
	$month	= substr( $time, 4, 2 );
	$day	= substr( $time, 6, 2 );
	$hour	= substr( $time, 8, 2 );
	$minute	= substr( $time, 10, 2 );
	$second	= substr( $time, 12, 2 );
	return "$year-$month-$day $hour:$minute:$second";
}
?>