<?php
	require_once( '../../config.php' );
	require_once( 'Pager/Pager.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$category	= $c->ch_forum->GetCategory( $_GET['cid'] );
	if( !$category )				$c->redirect( '/community/forum/' );
	
	$topic		= $c->ch_forumdata->gettopic( $_GET['id'] );
	if( !$topic )					$c->redirect( '/community/forum/' );
	
	$user		= $c->auth->islogin();
	$errmsg	= '';
	if( count( $_POST ) )
	{
		$errmsg = $c->ch_forumdata->validatemsg( $c->data['data'] );
		if( $c->check->IsSpam( $c->data['data']['body'] ) )	$errmsg .= '現在不具合が生じております。<br>';
		if( $errmsg == '' )
		{
			if( $user ) $c->data['data']['user_id'] = $user['id'];
			$c->data['data']['ip']			= $_SERVER['REMOTE_ADDR'];
			$c->data['data']['created']		= $c->ch_forumdata->to_datetime( time() );
			$c->data['data']['modified']	= $c->data['data']['created'];
			$c->ch_forumdata->insert( $c->data['data'] );
			$c->ch_forumdata->UpdateModified( $_GET['id'] );
			$c->redirect( '/community/forum/categories/' . $_GET['cid'] . '/topics/' . $_GET['id'] . '/1.html' );
		}
	}
	
	$c->set( 'data', $c->data['data'] );
	$c->set( 'category', $category );
	$c->set( 'topic', $topic );
	$c->set( 'errmsg', $errmsg );
	$c->set( 'user', $user );
}


function content( $data )
{
	$s	= new CSanitize();
?>
<h1>ちいたんフォーラム</h1>
<h2><?php print $data['topic']['title']; ?></h2>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php print $s->html( $data['topic']['name'] ); ?>
					</td>
					<td align="right">
						<?php print $data['topic']['modified']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $data['topic']['body'] ) ); ?>
		</td>
	</tr>
</table>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle" align="center">
			返信
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<div id="results"></div>
		</td>
	</tr>
</table>


<p align="center"><?php print $data['page']; ?></p>
<?php
	ob_start();
?>
			<form method="post" action="community/forum/res.php?cid=<?php print $data['category']['id']; ?>&id=<?php print $data['topic']['id']; ?>">
				<span class="errmsg"><?php print $data['errmsg']; ?></span>
				お名前<br>
				<?php if( !$data['user'] ) { ?>
				<input type="text" size=40 name="data/name" value="<?php print $data['data']['name']; ?>"><br>
				<?php } else { ?>
				<?php echo h( $data['user']['name'] ); ?>
				<input type="hidden" name="data/name" value="<?php print $data['user']['name']; ?>"><br>
				<?php } ?>
				内容<br>
				<textarea cols=50 rows=8 name="data/body"><?php print $s->html( $data['data']['body'] ); ?></textarea><br>
				パスワード（編集、削除時に使用します）<br>
				<input type="password" name="data/password"><br>
				<input type="submit" value="投稿">
				<input type="hidden" name="data/title" value="Re:<?php print $data['topic']['title']; ?>">
				<input type="hidden" name="data/cid" value="<?php print $data['category']['id']; ?>">
				<input type="hidden" name="data/parent" value="<?php print $data['topic']['id']; ?>">
			</form>
<?php
	$contents = ob_get_contents();
	ob_end_clean();
	$contents	= str_replace( array( "\n", "\r" ), '', $contents );
	$results	= mysep( $contents );
?>
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
	$s	= new CSanitize();
?>
<h1>Cheetan forum</h1>
<h2><?php print $data['topic']['title']; ?></h2>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php print $s->html( $data['topic']['name'] ); ?>
					</td>
					<td align="right">
						<?php print $data['topic']['modified']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $data['topic']['body'] ) ); ?>
		</td>
	</tr>
</table>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle" align="center">
			Res
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<div id="results"></div>
		</td>
	</tr>
</table>


<p align="center"><?php print $data['page']; ?></p>
<?php
	ob_start();
?>
			<form method="post" action="community/forum/res.php?cid=<?php print $data['category']['id']; ?>&id=<?php print $data['topic']['id']; ?>">
				<span class="errmsg"><?php print $data['errmsg']; ?></span>
				Name<br>
				<?php if( !$data['user'] ) { ?>
				<input type="text" size=40 name="data/name" value="<?php print $data['data']['name']; ?>"><br>
				<?php } else { ?>
				<?php echo h( $data['user']['name'] ); ?>
				<input type="hidden" name="data/name" value="<?php print $data['user']['name']; ?>"><br>
				<?php } ?>
				Body<br>
				<textarea cols=50 rows=8 name="data/body"><?php print $s->html( $data['data']['body'] ); ?></textarea><br>
				Password（Use when you edit）<br>
				<input type="password" name="data/password"><br>
				<input type="submit" value="Submit">
				<input type="hidden" name="data/title" value="Re:<?php print $data['topic']['title']; ?>">
				<input type="hidden" name="data/cid" value="<?php print $data['category']['id']; ?>">
				<input type="hidden" name="data/parent" value="<?php print $data['topic']['id']; ?>">
			</form>
<?php
	$contents = ob_get_contents();
	ob_end_clean();
	$contents	= str_replace( array( "\n", "\r" ), '', $contents );
	$results	= mysep( $contents );
?>
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