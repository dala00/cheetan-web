<?php
function is_secure()
{
	return false;
}

	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );

function action( &$c )
{
	$tmpuser = $c->ch_tmpuser->get( $_GET['id'], $_GET['sid'] );
	if( !$tmpuser )	exit;
	$c->ch_user->TmpuserToUser( $tmpuser );
	$c->ch_tmpuser->DelById( $_GET['id'] );
	$c->set( 'tmpuser', $tmpuser );
}


function content( $data )
{
?>
登録完了しました。<br>
<br>
<a href="user/login.php">ログインページへ</a>
<?php
}


function content_eng( $data )
{
?>
Registration finished.<br>
<br>
<a href="user/login.php">go to login page.</a>
<?php
}
