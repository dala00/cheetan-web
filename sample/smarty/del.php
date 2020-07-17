<?php
    require_once( "config.php" );
    require_once( "cheetan/cheetan.php" );

function action( &$c )
{
    if( count( $_POST ) )
    {
        $c->blog_data->del( "id=" . $_POST["id"] );
		$c->redirect( "." );
    }
    $c->set( "data", $c->blog_data->findone( "id=" . $_GET["id"] ) );
}
?>