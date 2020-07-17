<?php
	require_once( "config.php" );
	require_once( "cheetan/cheetan.php" );
	
function action( &$c )
{
	$c->SetViewFile( "index_.html" );
	$c->set( "datas", $c->blog_data->find( "", "modified DESC" ) );
}
?>