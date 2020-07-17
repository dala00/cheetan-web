<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );

function action( &$c )
{
	$errmsg	= '';
	if( count( $_POST ) )
	{
		$_POST	= array_map( 'stripslashes', $_POST );
		$name	= $c->s->postt('name');
		$email	= $c->s->postt('email');
		$url	= $c->s->postt('url');
		$body	= $c->s->postt('body');
		if( !$name )	$errmsg .= is_english() ? 'Input name.<br>' : '名前が入力されていません。<br>';
		if( !$email )	$errmsg .= is_english() ? 'Input email.<br>' : 'メールアドレスが入力されていません。<br>';
		if( !$body )	$errmsg .= is_english() ? 'Input Message.<br>' : '内容が入力されていません。<br>';
		if( preg_match_all( '/http/i', $body, $matches ) > 1 )	$errmsg .= '現在不具合が生じております。<br>';
		if( $errmsg == '' )
		{
			$msg	= "名前：$name
メールアドレス：$email
URL：$url
内容：
$body";
			if( preg_match( '/<a href/i', $_POST['body'] ) || $c->mail->put_email( $name, $email, 'cheetan@php.cheetan.net', 'ちいたんフォーム', $msg ) )
			{
				$_SESSION['flash']	= is_english() ? 'Mail is sent.<br>' : 'メッセージを送信いたしました。<br>';
				$c->redirect( 'http://' . $_SERVER['HTTP_HOST'] . '/community/contact.php' );
			}
			else
			{
				$errmsg = is_english() ? 'Failed to send mail.<br>' : 'メッセージ送信に失敗しました。<br>';
			}
		}
	}
	
	$c->set( 'errmsg', $errmsg );
	$c->set( 'data', $_POST );
	$c->set( 'flash', $_SESSION['flash'] );
	$_SESSION['flash'] = '';
}


function content( $data )
{
?>
<h1>お問い合わせ</h1>

<p>
内容にサイトアドレスを2つ以上入れると<br>
ス パムとみなします。<br>
<form method="post" action="community/contact.php">
<span class="errmsg"><?php print $data['flash']; ?></span>
<span class="errmsg"><?php print $data['errmsg']; ?></span>
お名前<font color="red">（必須）</font><br>
<input type="text" size=40 name="name" value="<?php print $data['data']['name']; ?>"><br>
メールアドレス<font color="red">（必須）</font><br>
<input type="text" size=40 name="email" value="<?php print $data['data']['email']; ?>"><br>
URL<br>
<input type="text" size=40 name="url" value="<?php print $data['data']['url']; ?>"><br>
内容<font color="red">（必須）</font><br>
<textarea cols="50" rows="8" name="body"><?php print $data['data']['body']; ?></textarea><br>
<br>
<input type="submit" value="送信">
</form>
</p>
  <?php
}





function content_eng( $data )
{
?>
<h1>Contact</h1>

<p>
<form method="post" action="community/contact.php">
<span class="errmsg"><?php print $data['flash']; ?></span>
<span class="errmsg"><?php print $data['errmsg']; ?></span>
Name<font color="red">（Need）</font><br>
<input type="text" size=40 name="name" value="<?php print $data['data']['name']; ?>"><br>
Email<font color="red">（Need）</font><br>
<input type="text" size=40 name="email" value="<?php print $data['data']['email']; ?>"><br>
URL<br>
<input type="text" size=40 name="url" value="<?php print $data['data']['url']; ?>"><br>
Message<font color="red">（Need）</font><br>
<textarea cols="50" rows="8" name="body"><?php print $data['data']['body']; ?></textarea><br>
<br>
<input type="submit" value="送信">
</form>
</p>
  <?php
}
?>