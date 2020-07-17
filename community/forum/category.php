<?php
	require_once( '../../config.php' );
	require_once( 'Pager/Pager.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$category	= $c->ch_forum->GetCategory( $_GET['id'] );
	if( !$category )				$c->redirect( '/community/forum/' );
	
	$page		= $_GET['page'];
	$topics		= $c->ch_forumdata->getall( $_GET['id'] );
		
	$c->set( 'category', $category );
	pager( $c, $category, $page, $topics );
}


function pager( &$c, &$category, $page, &$topics )
{
	$params	= array(
			"mode"		=> "Jumping",
			"append"	=> false,
			"perPage"	=> 10,
			"delta"		=> 5,
			"currentPage"	=> $page,
			"path"		=> '/community/forum/categories/' . $category['id'] . '/',
			"fileName"	=> "%d.html",
			"urlVar"	=> "page",
			"itemData"	=> $topics
			);
	$pager	= &Pager::factory( $params );
	$data	= $pager->getPageData();
	$links	= $pager->getLinks();
	$c->set( "page", $links["all"] );
	$c->set( "topics", $data );
	$c->set( "s", new CSanitize() );
}


function content( $data )
{
?>
<h1><a href="community/forum">ちいたんフォーラム</a></h1>
<h2><?php print $data['category']['name']; ?></h2>

<a href="community/forum/add.php?id=<?php print $data['category']['id']; ?>">&gt;&gt;新しいトピックを追加</a>

	<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
		<tr>
			<td class="forumtitle" align="center">
				タイトル
			</td>
			<td class="forumtitle" width="25%" align="center">
				更新時間
			</td>
			<td class="forumtitle" width="25%" align="center">
				レス数
			</td>
		</tr>
<?php foreach( $data['topics'] as $row ){ ?>
		<tr>
			<td class="forumtd">
				<a href="community/forum/categories/<?php print $row['cid']; ?>/topics/<?php print $row['id']; ?>/1.html"><?php print $data['s']->html( $row['title'] ); ?></a>
			</td>
			<td class="forumtd" width="25%" align="center">
				<?php print substr( $row['modified'], 0, 10 ); ?>
			</td>
			<td class="forumtd" width="25%" align="center">
				<?php print $row['count']; ?>
			</td>
		</tr>
<?php } ?>
	</table>

<p align="center"><?php print $data['page']; ?></p>
<?php
}


function content_eng( $data )
{
?>
<h1><a href="community/forum">Cheetan forum</a></h1>
<h2><?php print $data['category']['nameeng']; ?></h2>

<a href="community/forum/add.php?id=<?php print $data['category']['id']; ?>">&gt;&gt;Add new topic</a>

	<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
		<tr>
			<td class="forumtitle" align="center">
				title
			</td>
			<td class="forumtitle" width="25%" align="center">
				modified
			</td>
			<td class="forumtitle" width="25%" align="center">
				res
			</td>
		</tr>
<?php foreach( $data['topics'] as $row ){ ?>
		<tr>
			<td class="forumtd">
				<a href="community/forum/categories/<?php print $row['cid']; ?>/topics/<?php print $row['id']; ?>/1.html"><?php print $data['s']->html( $row['title'] ); ?></a>
			</td>
			<td class="forumtd" width="25%" align="center">
				<?php print substr( $row['modified'], 0, 10 ); ?>
			</td>
			<td class="forumtd" width="25%" align="center">
				<?php print $row['count']; ?>
			</td>
		</tr>
<?php } ?>
	</table>

<p align="center"><?php print $data['page']; ?></p>
<?php
}


?>