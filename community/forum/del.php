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
	
	if( count( $_POST ) )
	{
		$c->ch_forumdata->delete( $_GET['id'] );
		if( $topic['parent'] == -1 )
		{
			$c->redirect( '/community/forum/categories/' . $topic['cid'] . '/topics/' . $topic['id'] . '/1.html' );
		}
		else
		{
			$c->redirect( '/community/forum/categories/' . $topic['cid'] . '/topics/' . $topic['parent'] . '/1.html' );
		}
	}
	
	$c->set( 'data', $topic );
}


function content( $data )
{
	$s	= new CSanitize();
?>
<h1>ちいたんフォーラム</h1>

<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle" align="center">
			以下を削除します。よろしいですか？
			<?php if( $data['data']['parent'] == -1 ){ ?>
			<br>
			この記事を削除するとレスも全て削除されます。
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php if( $data['data']['parent'] == -1 ){ ?>
			<p>
			タイトル<br>
			<?php print $s->html( $data['data']['title'] ); ?><br>
			</p>
			<p>
			<?php } ?>
			お名前<br>
			<?php print $s->html( $data['data']['name'] ); ?><br>
			</p>
			<p>
			内容<br>
			<?php print str_replace( "\n", '<br>', $s->html( $data['data']['body'] ) ); ?><br>
			</p>
			<form method="post" action="/community/forum/del.php?id=<?php print $data['data']['id']; ?>">
			<input type="submit" name="del" value="削除">
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
			Delete this discription. OK?
			<?php if( $data['data']['parent'] == -1 ){ ?>
			<br>
			All response of this discription will be deleted.
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php if( $data['data']['parent'] == -1 ){ ?>
			<p>
			Title<br>
			<?php print $s->html( $data['data']['title'] ); ?><br>
			</p>
			<p>
			<?php } ?>
			Name<br>
			<?php print $s->html( $data['data']['name'] ); ?><br>
			</p>
			<p>
			Body<br>
			<?php print str_replace( "\n", '<br>', $s->html( $data['data']['body'] ) ); ?><br>
			</p>
			<form method="post" action="/community/forum/del.php?id=<?php print $data['data']['id']; ?>">
			<input type="submit" name="del" value="Del">
			</form>
		</td>
	</tr>
</table>


<?php
}

?>