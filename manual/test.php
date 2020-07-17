<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );
	
	
function action( &$c )
{
	pr($c->ch_user->describe());
	/*
	$data['name']	= '開発';
	$c->ch_forumdata->updateby( $data, "name='開発者'" );
	*/
	/*
	$data			= array();
	$data["name"]	= "testsan";
	$data["email"]	= "test@test.com";
//	$c->texttest->insert( $data );
	$data	= array();
	$data["id"]		= 4;
	$data["name"]	= "changed222";
	$c->texttest->update( $data );
	$c->set( "count", $c->texttest->getcount( '$id > 3') );
	$c->set( "data", $c->texttest->find() );
	*/
	
	/*
	$data			= array();
	$data["filename"]	= "archive/cheetan0.0.0.7.zip";
	$c->ch_dlcount->updateby( $data, "filename='archive/cheetan0.0.0.6.zip'" );
	*/
}

function content( $data, &$c )
{
echo $c->javascript->link( '/js/prototype' );
?>
<div id="test"></div>
<?php
echo $c->prototype->link( 'test', '/style.css', array( 'update' => 'test' ) );
}
?>