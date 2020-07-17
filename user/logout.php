<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$c->auth->logout();
	$c->redirect( '/' );
}
