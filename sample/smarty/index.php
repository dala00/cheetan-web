<?php
	require_once( "config.php" );
	require_once( "cheetan/cheetan.php" );
	
function action( &$c )
{
	$c->set( "datas", $c->blog_data->find( "", "modified DESC" ) );
}
?>