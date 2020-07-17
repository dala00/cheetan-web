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
	$c->data['user']	= array_map( 'stripslashes', $c->data['user'] );
	if( !empty( $_POST['back'] ) )
	{
		$c->SetViewFile( 'regist.html' );
	}
	else if( !empty( $c->data['user'] ) )
	{
		$is_english			= is_english();
		$c->data['user']	= array_map( 'trim', $c->data['user'] );
		$errmsg	.= $c->ch_user->validatemsg( $c->data['user'] );
		if( $c->ch_user->FindByEmail( $c->data['user']['email'] ) )	$errmsg .= $is_english ? 'Mail address is duplicated.<br>' : 'そのメールアドレスは既に登録されています。<br>';
		if( $errmsg != '' )
		{
			$c->SetViewFile( 'regist.html' );
		}
		else
		{
			$sid					= urlencode( md5( microtime() ) );
			$c->data['user']['sid']	= $sid;
			$c->ch_tmpuser->insert( $c->data['user'] );
			$id						= $c->ch_tmpuser->GetLastInsertId();
			$url					= 'http://' . $_SERVER['HTTP_HOST'] . "/user/complete.php?id=$id&sid=$sid";
			if( !$is_english )
			{
				$fromn	= 'ちいたん';
				$sbj	= '仮登録のおしらせ';
				$flash	= '登録しました。<br>送信したメールを大切に保管しておいて下さい。';
				$msg	= "登録を受け付けました。
以下のURLをクリックすることで本登録となります。

$url

";
			}
			else
			{
				$fromn	= 'Cheetan';
				$sbj	= 'Notice for pre-regist';
				$flash	= 'Pre-registed.<br>Save the mail I sent.';
				$msg	= "Your user information is registed temporary.
Click next URL to complete process.

$url

";
			}
			$c->mail->put_email( ADMIN_EMAIL, $fromn, $c->data['user']['email'], $sbj, $msg );
			$_SESSION['flash']	= $flash;
			$c->redirect( 'regist.php' );
		}
	}

	$c->set( 'user', $c->data['user'] );	
	$c->set( 'errmsg', $errmsg );
}
