<?php
function is_secure()
{
	return false;
}

	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );

function action( &$c )
{
	$errmsg	= '';
	if( !empty( $c->data['user'] ) )
	{
		$c->data['user']	= array_map( 'stripslashes', $c->data['user'] );
		$c->data['user']	= array_map( 'trim', $c->data['user'] );
		$errmsg	.= $c->ch_user->validatemsg( $c->data['user'] );
		if( $c->ch_user->FindByEmail( $c->data['user']['email'] ) )	$errmsg .= 'そのメールアドレスは既に登録されています。<br>';
		if( $errmsg == '' )
		{
		}
	}
	
	$c->set( 'errmsg', $errmsg );
}
