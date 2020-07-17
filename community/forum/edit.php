<?php
	require_once( '../../config.php' );
	require_once( 'Pager/Pager.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$topic		= $c->ch_forumdata->gettopicbyid( $_GET['id'] );
	if( !$topic )										$c->redirect( '/community/forum/' );
	if( $_SESSION['id'] != $_GET['id'] )				$c->redirect( '/community/forum/' );			
	if( $_SESSION['password'] != $topic['password'] )	$c->redirect( '/community/forum/' );
	
	$errmsg	= '';
	if( count( $_POST ) )
	{
		$errmsg = $c->ch_forumdata->validatemsg( $c->data['data'] );
		if( $errmsg == '' )
		{
			$c->data['data']['ip']			= $_SERVER['REMOTE_ADDR'];
			$c->data['data']['modified']	= $c->ch_forumdata->to_datetime( time() );
			$c->ch_forumdata->update( $c->data['data'] );
			if( $topic['parent'] == -1 )
			{
				$c->redirect( '/community/forum/categories/' . $topic['cid'] . '/topics/' . $topic['id'] . '/1.html' );
			}
			else
			{
				$c->redirect( '/community/forum/categories/' . $topic['cid'] . '/topics/' . $topic['parent'] . '/1.html' );
			}
		}
	}
	
	$c->set( 'data', $topic );
	$c->set( 'errmsg', $errmsg );
}


function content( $data )
{
	$s	= new CSanitize();
?>
<h1>ちいたんフォーラム</h1>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle" align="center">
			修正
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<form method="post" action="/community/forum/edit.php?id=<?php print $data['data']['id']; ?>">
			<?php if( $data['data']['parent'] == -1 ){ ?>
			タイトル<br>
			<input type="text" size=40 name="data/title" value="<?php print $s->html( $data['data']['title'] ); ?>"><br>
			<?php } ?>
			お名前<br>
			<input type="text" size=40 name="data/name" value="<?php print $s->html( $data['data']['name'] ); ?>"><br>
			内容<br>
			<textarea cols=50 rows=8 name="data/body"><?php print $s->html( $data['data']['body'] ); ?></textarea><br>
			<input type="hidden" name="data/id" value="<?php print $data['data']['id']; ?>">
			<input type="submit" value="修正">
			</form>
		</td>
	</tr>
</table>


<?php
}



function content_eng( $data )
{
	$s	= new CSanitize();
?>
<h1>Cheetan forum</h1>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle" align="center">
			Edit
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<form method="post" action="/community/forum/edit.php?id=<?php print $data['data']['id']; ?>">
			<?php if( $data['data']['parent'] == -1 ){ ?>
			Title<br>
			<input type="text" size=40 name="data/title" value="<?php print $s->html( $data['data']['title'] ); ?>"><br>
			<?php } ?>
			Name<br>
			<input type="text" size=40 name="data/name" value="<?php print $s->html( $data['data']['name'] ); ?>"><br>
			Body<br>
			<textarea cols=50 rows=8 name="data/body"><?php print $s->html( $data['data']['body'] ); ?></textarea><br>
			<input type="hidden" name="data/id" value="<?php print $data['data']['id']; ?>">
			<input type="submit" value="Edit">
			</form>
		</td>
	</tr>
</table>


<?php
}

?>