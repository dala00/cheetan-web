<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );
	
function action( &$c )
{
	$c->ch_dlcount->add( $_GET["filename"] );
	$c->redirect( "../" . $_GET["filename"] );
}
?>