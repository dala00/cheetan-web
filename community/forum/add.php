<?php
	require_once( '../../config.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$category	= $c->ch_forum->GetCategory( $_GET['id'] );
	if( !$category )	$c->redirect( '/community/forum/' );
	
	$errmsg		= '';
	$user		= $c->auth->islogin();
	if( count( $_POST ) )
	{
		if( empty( $_SESSION['add_ok'] ) )	$c->redirect( 'http://www.yahoo.co.jp' );
		$errmsg	= $c->ch_forumdata->validatemsg( $c->data['data'] );
		if( $c->check->IsSpam( $c->data['data']['body'] ) )	$errmsg .= '現在不具合が生じております。<br>';
		if( $errmsg == '' )
		{
			if( $user )
			{
				$c->data['data']['user_id'] = $user['id'];
			}
			$c->data['data']['ip']			= $_SERVER['REMOTE_ADDR'];
			$c->data['data']['created']		= $c->ch_forumdata->to_datetime( time() );
			$c->data['data']['modified']	= $c->data['data']['created'];
			$c->ch_forumdata->insert( $c->data['data'] );
			unset( $_SESSION['add_ok'] );
			$c->redirect( '/community/forum/categories/' . $_GET['id'] . '/1.html' );
		}
	}
	
	$c->set( 'data', $c->data['data'] );
	$c->set( 'category', $category );
	$c->set( 'errmsg', $errmsg );
	$c->set( 'user', $user );
	$_SESSION['add_ok']	= true;
}


function content( $data )
{
	ob_start();
?>
<h1>「<?php print $data['category']['name']; ?>」に新しいトピックを追加</h1>

<form method="post" action="community/forum/add.php?id=<?php print $data['category']['id']; ?>">
<span class="errmsg"><?php print $data['errmsg']; ?></span>
タイトル<br>
<input type="text" size=40 name="data/title" value="<?php print $data['data']['title']; ?>"><br>
お名前<br>
<?php if( !$data['user'] ) { ?>
<input type="text" size=40 name="data/name" value="<?php print $data['data']['name']; ?>"><br>
<?php } else { ?>
<?php echo h( $data['user']['name'] ); ?>
<input type="hidden" name="data/name" value="<?php print $data['user']['name']; ?>"><br>
<?php } ?>
内容<br>
<textarea cols="50" rows="8" name="data/body"><?php print $data['data']['body']; ?></textarea><br>
パスワード（編集、削除時に使用します）<br>
<input type="password" name="data/password" value="<?php print $data['data']['password']; ?>"><br>
<input type="hidden" name="data/cid" value="<?php print $data['category']['id']; ?>">
<input type="hidden" name="data/parent" value="-1">
<input type="submit" value="投稿">
</form>
<?php
	$contents = ob_get_contents();
	ob_end_clean();
	$contents	= str_replace( array( "\n", "\r" ), '', $contents );
	$results	= mysep( $contents );
?>
<div id="results"></div>
<script type="text/javascript">
<!--
var tag = '';
<?php foreach( $results as $row ){ ?>
tag += '<?php echo $row; ?>';
<?php } ?>
document.getElementById( 'results' ).innerHTML = tag;
//-->
</script>
<?php
}


function content_eng( $data )
{
	ob_start();
?>
<h1>Add new topic to 「<?php print $data['category']['nameeng']; ?>」</h1>

<form method="post" action="community/forum/add.php?id=<?php print $data['category']['id']; ?>">
<span class="errmsg"><?php print $data['errmsg']; ?></span>
Title<br>
<input type="text" size=40 name="data/title" value="<?php print $data['data']['title']; ?>"><br>
Name<br>
<?php if( !$data['user'] ) { ?>
<input type="text" size=40 name="data/name" value="<?php print $data['data']['name']; ?>"><br>
<?php } else { ?>
<?php echo h( $data['user']['name'] ); ?>
<input type="hidden" name="data/name" value="<?php print $data['user']['name']; ?>"><br>
<?php } ?>
Body<br>
<textarea cols="50" rows="8" name="data/body"><?php print $data['data']['body']; ?></textarea><br>
Password（Use it when you edit）<br>
<input type="password" name="data/password" value="<?php print $data['data']['password']; ?>"><br>
<input type="hidden" name="data/cid" value="<?php print $data['category']['id']; ?>">
<input type="hidden" name="data/parent" value="-1">
<input type="submit" value="Submit">
</form>
<?php
	$contents = ob_get_contents();
	ob_end_clean();
	$contents	= str_replace( array( "\n", "\r" ), '', $contents );
	$results	= mysep( $contents );
?>
<div id="results"></div>
<script type="text/javascript">
<!--
var tag = '';
<?php foreach( $results as $row ){ ?>
tag += '<?php echo $row; ?>';
<?php } ?>
document.getElementById( 'results' ).innerHTML = tag;
//-->
</script>
<?php
}

?>