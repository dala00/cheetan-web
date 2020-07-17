<?php
	require_once( '../../config.php' );
	require_once( '../../cheetan/cheetan.php' );

function action( &$c )
{
	$categories	= $c->ch_forum->GetCategories();
	foreach( $categories as $i => $category )
	{
		$categories[$i]['topics']	= $c->ch_forumdata->getall( $category['id'], 5 );
	}
	$c->set( 'categories', $categories );
}


function content( $data )
{
?>
<h1>ちいたんフォーラム</h1>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<?php foreach( $data['categories'] as $row ){ ?>
	<tr>
		<td class="forumtd" width="50%">
			<a href="/community/forum/categories/<?php print $row['id']; ?>/1.html"><?php print $row['name']; ?></a>
			<ul>
			<?php foreach( $row['topics'] as $topic ){ ?>
				<li><a href="community/forum/categories/<?php print $topic['cid']; ?>/topics/<?php print $topic['id']; ?>/1.html"><?php print htmlspecialchars( $topic['title'] ); ?></a>&nbsp;&nbsp;<?php echo $topic['modified']; ?></li>
			<?php } ?>
			</ul>
		</td>
	</tr>		
	<?php } ?>
</table>
<?php
}


function content_eng( $data )
{
?>
<h1>Cheetan forum</h1>
<table border=0 cellpadding=0 cellspacing=1 class="forum" width="90%">
	<?php foreach( $data['categories'] as $row ){ ?>
	<tr>
		<td class="forumtd" width="50%">
			<a href="/community/forum/categories/<?php print $row['id']; ?>/1.html"><?php print $row['nameeng']; ?></a>
		</td>
	</tr>		
	<?php } ?>
</table>
<?php
}

?>