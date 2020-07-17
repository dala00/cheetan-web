<?php
	require_once( '../../config.php' );
	require_once( 'Pager/Pager.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$category	= $c->ch_forum->GetCategory( $_GET['cid'] );
	if( !$category )				$c->redirect( '/community/forum/' );
	
	$page		= $_GET['page'];
	$topic		= $c->ch_forumdata->gettopic( $_GET['id'] );
	if( !$topic )					$c->redirect( '/community/forum/' );
	
	$errmsg		= '';
	if( count( $_POST ) )
	{
		$id						= $_POST['id'];
		$password				= $_POST['password'];
		$_SESSION['id']			= $id;
		$_SESSION['password']	= $password;
		if( $child = $c->ch_forumdata->getchildbyid( $_GET['id'], $id ) )
		{
			if( $child['password'] != $password )
			{
				$errmsg	= is_english() ? 'Wrong password.<br>' : 'パスワードが違います。<br>';
			}
			if( $errmsg == '' )
			{
				if( $_POST['edit'] )		$c->redirect( "/community/forum/edit.php?id=$id" );
				else if( $_POST['del'] )	$c->redirect( "/community/forum/del.php?id=$id" );
			}
		}
		if( $topic['password'] != $password )
		{
			$errmsg	= is_english() ? 'Wrong password.<br>' : 'パスワードが違います。<br>';
		}
		if( $errmsg == '' )
		{
			if( $_POST['edit'] )		$c->redirect( "/community/forum/edit.php?id=$id" );
			else if( $_POST['del'] )	$c->redirect( "/community/forum/del.php?id=$id" );
		}
	}
	
	$children	= $c->ch_forumdata->getchild( $_GET['id'] );
		
	$c->set( 'category', $category );
	$c->set( 'topic', $topic );
	$c->set( 'errmsg', $errmsg );
	pager( $c, $category, $topic, $page, $children );
}


function pager( &$c, &$category, &$topic, $page, &$topics )
{
	$params	= array(
			"mode"		=> "Jumping",
			"append"	=> false,
			"perPage"	=> 10,
			"delta"		=> 5,
			"currentPage"	=> $page,
			"path"		=> '/community/forum/categories/' . $category['id'] . '/topics/' . $topic['id'] . '/',
			"fileName"	=> "%d.html",
			"urlVar"	=> "page",
			"itemData"	=> $topics
			);
	$pager	= &Pager::factory( $params );
	$data	= $pager->getPageData();
	$links	= $pager->getLinks();
	$c->set( "page", $links["all"] );
	$c->set( "children", $data );
}


function content( $data )
{
	$s	= new CSanitize();
?>
<h1><a href="community/forum">ちいたんフォーラム</a></h1>
<a href="community/forum/categories/<?php print $data['category']['id']; ?>/1.html"><?php print $data['category']['name']; ?></a>
 &gt;&gt; <?php print $data['topic']['title']; ?>
<hr size=1>
<br>

<span class="errmsg"><?php print $data['errmsg']; ?></span>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php if( $data['topic']['user_id'] ){ ?>
							<a href="user/<?php echo $data['topic']['user_id']; ?>"><?php echo h( $data['topic']['name'] ); ?></a>
						<?php } else { ?>
							<?php print $s->html( $data['topic']['name'] ); ?>
						<?php } ?>
					</td>
					<td align="right">
						<?php print $data['topic']['created']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $data['topic']['body'] ) ); ?>
			<hr size=1 width="98%">
			<div align="right">
				<form method="post" action="community/forum/categories/<?php print $data['category']['id']; ?>/topics/<?php print $data['topic']['id']; ?>/1.html">
				<a href="community/forum/res.php?cid=<?php print $data['category']['id']; ?>&id=<?php print $data['topic']['id']; ?>">返信</a>&nbsp;
				パスワード
				<input type="password" size=8 name="password">&nbsp;
				<input type="submit" name="edit" value="編集">&nbsp;
				<input type="submit" name="del" value="削除">&nbsp;
				<input type="hidden" name="id" value="<?php print $data['topic']['id']; ?>">
				</form>
			</div>
		</td>
	</tr>
</table>

<br><br>

<?php foreach( $data['children'] as $row ){ ?>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php if( $row['user_id'] ){ ?>
							<a href="user/<?php echo $row['user_id']; ?>"><?php echo h( $row['name'] ); ?></a>
						<?php } else { ?>
							<?php print $s->html( $row['name'] ); ?>
						<?php } ?>
					</td>
					<td align="right">
						<?php print $row['created']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $row['body'] ) ); ?>
			<hr size=1 width="98%">
			<div align="right">
				<form method="post" action="community/forum/categories/<?php print $data['category']['id']; ?>/topics/<?php print $data['topic']['id']; ?>/1.html">
				パスワード
				<input type="password" size=8 name="password">&nbsp;
				<input type="submit" name="edit" value="編集">&nbsp;
				<input type="submit" name="del" value="削除">&nbsp;
				<input type="hidden" name="id" value="<?php print $row['id']; ?>">
				</form>
			</div>
		</td>
	</tr>
</table>
<br>
<?php } ?>
<p align="center"><?php print $data['page']; ?></p>
<?php
}



function content_eng( $data )
{
	$s	= new CSanitize();
?>
<h1><a href="community/forum">Cheetan forum</a></h1>
<a href="community/forum/categories/<?php print $data['category']['id']; ?>/1.html"><?php print $data['category']['nameeng']; ?></a>
 &gt;&gt; <?php print $data['topic']['title']; ?>
<hr size=1>
<br>

<span class="errmsg"><?php print $data['errmsg']; ?></span>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php if( $data['topic']['user_id'] ){ ?>
							<a href="user/<?php echo $data['topic']['user_id']; ?>"><?php echo h( $data['topic']['name'] ); ?></a>
						<?php } else { ?>
							<?php print $s->html( $data['topic']['name'] ); ?>
						<?php } ?>
					</td>
					<td align="right">
						<?php print $data['topic']['created']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $data['topic']['body'] ) ); ?>
			<hr size=1 width="98%">
			<div align="right">
				<form method="post" action="community/forum/categories/<?php print $data['category']['id']; ?>/topics/<?php print $data['topic']['id']; ?>/1.html">
				<a href="community/forum/res.php?cid=<?php print $data['category']['id']; ?>&id=<?php print $data['topic']['id']; ?>">Res</a>&nbsp;
				password
				<input type="password" size=8 name="password">&nbsp;
				<input type="submit" name="edit" value="Edit">&nbsp;
				<input type="submit" name="del" value="Del">&nbsp;
				<input type="hidden" name="id" value="<?php print $data['topic']['id']; ?>">
				</form>
			</div>
		</td>
	</tr>
</table>

<br><br>

<?php foreach( $data['children'] as $row ){ ?>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<tr>
		<td class="forumtitle">
			<table border=0 cellpadding=0 cellspacing=0 width="100%">
				<tr>
					<td>
						<?php if( $row['user_id'] ){ ?>
							<a href="user/<?php echo $row['user_id']; ?>"><?php echo h( $row['name'] ); ?></a>
						<?php } else { ?>
							<?php print $s->html( $row['name'] ); ?>
						<?php } ?>
					</td>
					<td align="right">
						<?php print $row['created']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="forumtd">
			<?php print str_replace( "\n", '<br>', $s->html( $row['body'] ) ); ?>
			<hr size=1 width="98%">
			<div align="right">
				<form method="post" action="community/forum/categories/<?php print $data['category']['id']; ?>/topics/<?php print $data['topic']['id']; ?>/1.html">
				パスワード
				<input type="password" size=8 name="password">&nbsp;
				<input type="submit" name="edit" value="編集">&nbsp;
				<input type="submit" name="del" value="削除">&nbsp;
				<input type="hidden" name="id" value="<?php print $row['id']; ?>">
				</form>
			</div>
		</td>
	</tr>
</table>
<br>
<?php } ?>
<p align="center"><?php print $data['page']; ?></p>
<?php
}


?>