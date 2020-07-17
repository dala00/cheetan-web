<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user		= $c->auth->islogin();
	$update		= $c->ch_project_update->get( $_GET['id'], $user['id'] );
	if( !$update )	exit;
	$errmsg		= '';
	if( count( $_POST ) )
	{
		$c->ch_project_update->DelUpdate( $_GET['id'] );
		$_SESSION['flash']	= is_english() ? 'You deleted update.' : '更新情報を削除しました。';
		$c->redirect( '/user/project_updates.php?id=' . $update['project_id'] );
	}
	else
	{
		$c->set( 'update', $update );
	}
	
	$c->set( 'project', $project );
	$c->set( 'errmsg', $errmsg );
}


function content( $data, &$c )
{
?>
<h1>更新情報削除</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_update_del.php?id=<?php echo $_GET['id']; ?>">
<label for="update/name">タイトル<?php echo $c->helper->need(); ?></label><br>
<?php echo htmlspecialchars( $data['update']['name'] ); ?><br><br>
<label for="update/body">内容<?php echo $c->helper->need(); ?></label><br>
<?php echo str_replace( "\n", '<br>', htmlspecialchars( $data['update']['body'] ) ); ?><br><br>
<input type="hidden" name="submit" value="1">
<input type="submit" value="削除">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Modify update</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_update_edit.php?id=<?php echo $_GET['id']; ?>">
<label for="update/name">Title<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="update/name" value="<?php echo htmlspecialchars( $data['update']['name'] ); ?>" size="50"><br>
<label for="update/body">Body<?php echo $c->helper->need(); ?></label><br>
<textarea name="update/body" cols="50" rows="10"><?php echo htmlspecialchars( $data['update']['body'] ); ?></textarea><br>
<input type="hidden" name="submit" value="1">
<input type="submit" value="save">
</form>
<?php
}