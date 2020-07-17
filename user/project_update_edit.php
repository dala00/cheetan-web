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
		$errmsg	.= $c->ch_project_update->validatemsg( $c->data['update'] );
		if( $errmsg == '' )
		{
			$c->data['update']['id']	= $_GET['id'];
			$c->ch_project_update->update( $c->data['update'] );
			$_SESSION['flash']	= is_english() ? 'You modified update.' : '更新情報を編集しました。';
			$c->redirect( '/user/project_updates.php?id=' . $update['project_id'] );
		}
		
		$c->set( 'update', $c->data['update'] );
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
<h1>更新情報編集</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_update_edit.php?id=<?php echo $_GET['id']; ?>">
<label for="update/name">タイトル<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="update/name" value="<?php echo htmlspecialchars( $data['update']['name'] ); ?>" size="50"><br>
<label for="update/body">内容<?php echo $c->helper->need(); ?></label><br>
<textarea name="update/body" cols="50" rows="10"><?php echo htmlspecialchars( $data['update']['body'] ); ?></textarea><br>
<input type="submit" value="保存">
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
<input type="submit" value="save">
</form>
<?php
}