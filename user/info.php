<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$errmsg	= '';
	$user	= $c->auth->islogin();
	if( !empty( $_POST ) )
	{
		if( !$c->data['User']['email'] )	unset( $c->data['User']['email'] );
		else
		{
			if( $c->ch_user->is_duplicate( $user['id'], $c->data['User']['email'] ) )
			{
				$errmsg .= is_english() ? 'Specified email is already used by other user.' : 'そのアドレスは既に使用されています。';
			}
		}
		if( !$c->data['User']['password'] )	unset( $c->data['User']['password'] );
		else
		{
			if( $c->data['User']['password'] != $_POST['password2'] )
			{
				$errmsg	.= is_english() ? 'Password is differ.<br>' : 'パスワードが違います。<br>';
			}
		}
		$errmsg	.= $c->ch_user->validatemsg( $c->data['User'] );
		if( $errmsg == '' )
		{
			$c->data['User']['id']	= $user['id'];
			$c->ch_user->update( $c->data['User'] );
			$user	= $c->ch_user->get( $user['id'] );
			$c->auth->update( $user );
			$_SESSION['flash']	= is_english() ? 'Saved.' : '保存しました。';
			$c->redirect( '/user/info.php' );
		}
		$user	= $this->data['User'];
	}
	$c->set( 'user', $user );
	$c->set( 'errmsg', $errmsg );
}


function content( $data )
{
?>
<h1>ユーザー情報編集</h1>
変更する場合のみ入力して下さい。<br>
<br>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/info.php">
<label for="User/email">メールアドレス</label><br>
（現在の設定:<?php echo htmlspecialchars( $data['user']['email'] ); ?>）<br>
<input type="text" name="User/email" size="30"><br>
<label for="User/password">パスワード</label><br>
<input type="password" name="User/password"><br>
<label for="password2">パスワード（確認用）</label><br>
<input type="password" name="password2"><br>
<input type="submit" value="保存">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Edit user information</h1>
Input only which you want to change.<br>
<br>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/info.php">
<label for="User/email">Mail address</label><br>
（current setting:<?php echo htmlspecialchars( $data['user']['email'] ); ?>）<br>
<input type="text" name="User/email" size="30"><br>
<label for="User/password">Password</label><br>
<input type="password" name="User/password"><br>
<label for="password2">Password(for confirm)</label><br>
<input type="password" name="password2"><br>
<input type="submit" value="保存">
</form>
<?php
}