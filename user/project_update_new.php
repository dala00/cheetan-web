<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user		= $c->auth->islogin();
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	if( $project['user_id'] != $user['id'] )	exit;
	$errmsg		= '';
	if( count( $_POST ) )
	{
		$errmsg	.= $c->ch_project_update->validatemsg( $c->data['update'] );
		if( $errmsg == '' )
		{
			$c->data['update']['project_id']	= $_GET['id'];
			$c->data['update']['created']	= $c->ch_project->to_datetime();
			$c->ch_project_update->insert( $c->data['update'] );
			$_SESSION['flash']	= is_english() ? 'You created update.' : '更新情報を追加しました。';
			$c->redirect( '/user/project_updates.php?id=' . $_GET['id'] );
		}
		
		$c->set( 'update', $c->data['update'] );
	}
	
	$c->set( 'project', $project );
	$c->set( 'errmsg', $errmsg );
}


function content( $data, &$c )
{
?>
<h1><?php echo h( $data['project']['name'] ); ?>の更新情報追加</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_update_new.php?id=<?php echo $data['project']['id']; ?>">
<label for="update/name">タイトル<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="update/name" value="<?php echo htmlspecialchars( $data['update']['name'] ); ?>" size="50"><br>
<label for="update/body">内容<?php echo $c->helper->need(); ?></label><br>
<textarea name="update/body" cols="50" rows="10"><?php echo htmlspecialchars( $data['update']['body'] ); ?></textarea><br>
<input type="submit" value="作成" onclick="if( !confirm( 'この内容で作成します。よろしいですか？' ) ) return false;">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Add <?php echo h( $data['project']['name_english'] ); ?>' update</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_update_new.php?id=<?php echo $data['project']['id']; ?>">
<label for="update/name">Title<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="update/name" value="<?php echo htmlspecialchars( $data['update']['name'] ); ?>" size="50"><br>
<label for="update/body">Body<?php echo $c->helper->need(); ?></label><br>
<textarea name="update/body" cols="50" rows="10"><?php echo htmlspecialchars( $data['update']['body'] ); ?></textarea><br>
<input type="submit" value="Add" onclick="if( !confirm( 'Create OK ?' ) ) return false;">
</form>
<?php
}