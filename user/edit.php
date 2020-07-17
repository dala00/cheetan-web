<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$errmsg	= '';
	$user	= $c->auth->islogin();
	if( !empty( $_POST ) )
	{
		$errmsg	= $c->ch_user->validatemsg( $c->data['User'] );
		if( $errmsg == '' )
		{
			$c->data['User']['id']	= $user['id'];
			$c->ch_user->update( $c->data['User'] );
			$user	= $c->ch_user->get( $user['id'] );
			$c->auth->update( $user );
			$_SESSION['flash']	= is_english() ? 'Saved.' : '保存しました。';
			$c->redirect( '/user/edit.php' );
		}
	}
	$c->set( 'user', $user );
	$c->set( 'errmsg', $errmsg );
}


function content( $data )
{
?>
<h1>ユーザー情報編集</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/edit.php">
<label for="User/name">ニックネーム</label><br>
<input type="text" name="User/name" value="<?php echo htmlspecialchars( $data['user']['name'] ); ?>" size="30"><br>
<label for="User/url">サイトURL</label><br>
<input type="text" name="User/url" value="<?php echo htmlspecialchars( $data['user']['url'] ); ?>" size="30"><br>
<label for="User/intro">紹介文</label><br>
<textarea name="User/intro" cols="40" rows="6"><?php echo htmlspecialchars( $data['user']['intro'] ); ?></textarea><br>
<input type="submit" value="保存">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Edit profile</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/edit.php">
<label for="User/name">Nickname</label><br>
<input type="text" name="User/name" value="<?php echo htmlspecialchars( $data['user']['name'] ); ?>" size="30"><br>
<label for="User/url">Site URL</label><br>
<input type="text" name="User/url" value="<?php echo htmlspecialchars( $data['user']['url'] ); ?>" size="30"><br>
<label for="User/intro">Your introduction</label><br>
<textarea name="User/intro" cols="40" rows="6"><?php echo htmlspecialchars( $data['user']['intro'] ); ?></textarea><br>
<input type="submit" value="Save">
</form>
<?php
}