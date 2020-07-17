<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user		= $c->auth->islogin();
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	if( $project['user_id'] != $user['id'] )	exit;
	$page		= $c->page->pager( $c->ch_project_update->GetProjectUpdatesCount( $_GET['id'] ) );
	$updates	= $c->ch_project_update->GetProjectUpdates( $_GET['id'], $page, PAGE_DISP_NUM );
	$c->set( 'updates', $updates );
	$c->set( 'project', $project );
}


function content( $data, &$c )
{
?>
<h1><?php echo h( $data['project']['name'] ); ?>の更新情報</h1>
<p>
<a href="user/project_update_new.php?id=<?php echo $data['project']['id']; ?>">新規作成</a>
</p>
<p><?php $c->page->display(); ?></p>
<table class="mytable">
	<tr>
		<th>日付</th>
		<th>タイトル</th>
		<th>内容</th>
		<th>アクション</th>
	</tr>
<?php foreach( $data['updates'] as $update ){ ?>
	<tr>
		<td><?php echo substr( $update['created'], 0, 10 ); ?></td>
		<td><?php echo h( $update['name'] ); ?></td>
		<td><?php echo h( substr( $update['body'], 0, 120 ) ); ?></td>
		<td style="text-align: center;">
			<a href="user/project_update_edit.php?id=<?php echo $update['id']; ?>">編集</a>&nbsp;
			<a href="user/project_update_del.php?id=<?php echo $update['id']; ?>">削除</a>
		</td>
	</tr>
<?php } ?>
</table>
<?php
}


function content_eng( $data )
{
?>
<h1><?php echo h( $data['project']['name_english'] ); ?>'s updates</h1>
<p>
<a href="user/project_update_new.php?id=<?php echo $data['project']['id']; ?>">Add new update</a>
</p>
<table class="mytable">
	<tr>
		<th>created</th>
		<th>title</th>
		<th>body</th>
		<th>action</th>
	</tr>
<?php foreach( $data['updates'] as $update ){ ?>
	<tr>
		<td><?php echo substr( $update['created'], 0, 10 ); ?></td>
		<td><?php echo h( $update['name'] ); ?></td>
		<td><?php echo h( substr( $update['body'], 0, 120 ) ); ?></td>
		<td style="text-align: center;">
			<a href="user/project_update_edit.php?id=<?php echo $update['id']; ?>">edit</a>&nbsp;
			<a href="user/project_update_del.php?id=<?php echo $update['id']; ?>">delete</a>
		</td>
	</tr>
<?php } ?>
</table>
<?php
}