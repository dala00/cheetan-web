<?php
    require_once( "config.php" );
    require_once( "cheetan/cheetan.php" );

function action( &$c )
{
	$errmsg	= "";
    if( count( $_POST ) )
    {
		$errmsg	= $c->blog_data->validatemsg( $c->data["blog"] );
		if( preg_match( '/http:\/\//', $c->data['blog']['body'] ) ) $errmsg .= "You can't write URL.<br>";
		if( $errmsg == "" )
		{
	        $c->blog_data->insert( $c->data["blog"] );
			$c->redirect( "." );
		}
    }
	
	$c->set( "errmsg", $errmsg );
}
?>