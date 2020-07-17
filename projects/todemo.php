<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	if( !$project['demo_url'] )	exit;
	$c->ch_project->point( $_GET['id'], 'site_count', 'site_lastsid' );
	$c->redirect( $project['demo_url'] );
}
