<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	if( !$project['download_url'] )	exit;
	$c->ch_project->point( $_GET['id'], 'download_count', 'download_lastsid' );
	$c->redirect( $project['download_url'] );
}
