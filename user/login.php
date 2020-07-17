<?php
function is_secure()
{
	return false;
}

	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	if( $c->auth->islogin() )	$c->redirect( '/user/' );
	if( count( $_POST ) )
	{
		if( $user = $c->ch_user->FindLogin( $_POST ) )
		{
			$c->auth->login( $user );
			$c->redirect( '/user/' );
		}
		$_SESSION['flash']	= is_english() ? 'ID or password is no right.' : 'ID、もしくはパスワードが正しくありません。';
	}
}


function content( $data )
{
?>
<h1>ログイン</h1>
<form method="post" action="user/login.php">
<label for="email">メールアドレス</label><br>
<input type="text" name="email" size="40"><br>
<label for="password">パスワード</label><br>
<input type="password" name="password"><br>
<input type="submit" value="ログイン">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Login</h1>
<form method="post" action="user/login.php">
<label for="email">Email</label><br>
<input type="text" name="email" size="40"><br>
<label for="password">Password</label><br>
<input type="password" name="password"><br>
<input type="submit" value="Login">
</form>
<?php
}