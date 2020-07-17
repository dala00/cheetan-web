<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user		= $c->auth->islogin();
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	if( $project['user_id'] != $user['id'] )	exit;
	if( count( $_POST ) )
	{
		$c->ch_project->DelProject( $user['id'], $_GET['id'] );
		$_SESSION['flash']	= is_english() ? 'You deleted project.' : 'プロジェクトを削除しました。';
		$c->redirect( '/user/projects.php' );
	}
	else
	{
		$c->set( 'project', $project );
	}
}


function content( $data, &$c )
{
?>
<h1>プロジェクト削除</h1>
<font color="red">削除してよろしいですか？</font><br>
<br>
<form method="post" action="user/project_del.php?id=<?php echo htmlspecialchars( $_GET['id'] ); ?>">
<label for="Project/name">プロジェクト名</label><br>
<?php echo htmlspecialchars( $data['project']['name'] ); ?><br><br>
<label for="Project/name_english">プロジェクト名（英語表記）</label><br>
<?php echo htmlspecialchars( $data['project']['name_english'] ); ?><br><br>
<label for="Project/description">概要</label><br>
<?php echo str_replace( "\n", '<br>', htmlspecialchars( $data['project']['description'] ) ); ?><br><br>
<input type="hidden" name="submit" value="1">
<input type="submit" value="削除">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>Delete project</h1>
<font color="red">Delete OK ?</font><br>
<br>
<form method="post" action="user/project_del.php?id=<?php echo htmlspecialchars( $_GET['id'] ); ?>">
<label for="Project/name">Project name</label><br>
<?php echo htmlspecialchars( $data['project']['name'] ); ?><br><br>
<label for="Project/name_english">Project name(in English)</label><br>
<?php echo htmlspecialchars( $data['project']['name_english'] ); ?><br><br>
<label for="Project/description">Description</label><br>
<?php echo str_replace( "\n", '<br>', htmlspecialchars( $data['project']['description'] ) ); ?><br><br>
<input type="hidden" name="submit" value="1">
<input type="submit" value="Delete">
</form>
<?php
}