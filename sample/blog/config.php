<?php
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
	$controller->SetTemplateFile( "template.html" );
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