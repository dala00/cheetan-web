<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user		= $c->auth->islogin();
	$page		= $c->page->pager( $c->ch_project->GetProjectsCount( $user['id'] ) );
	$projects	= $c->ch_project->GetProjects( $user['id'], $page, PAGE_DISP_NUM );
	$c->set( 'projects', $projects );
}


function content( $data, &$c )
{
?>
<h1>プロジェクト</h1>
<p>
<a href="user/project_new.php">新規作成</a>
</p>
<p><?php $c->page->display(); ?></p>
<table class="mytable">
	<tr>
		<th>プロジェクト</th>
		<th>view</th>
		<th>site</th>
		<th>download</th>
		<th>アクション</th>
	</tr>
<?php foreach( $data['projects'] as $project ){ ?>
	<tr>
		<td><a href="projects/<?php echo $project['id']; ?>"><?php echo htmlspecialchars( $project['name'] ); ?></a></td>
		<td><?php echo $project['view_count']; ?></td>
		<td><?php echo $project['site_count']; ?></td>
		<td><?php echo $project['download_count']; ?></td>
		<td style="text-align: center;">
			<a href="user/project_edit.php?id=<?php echo $project['id']; ?>">編集</a>&nbsp;
			<a href="user/project_updates.php?id=<?php echo $project['id']; ?>">更新情報</a>&nbsp;
			<a href="user/project_del.php?id=<?php echo $project['id']; ?>">削除</a>
		</td>
	</tr>
<?php } ?>
</table>
<?php
}


function content_eng( $data )
{
?>
<h1>Projects</h1>
<p>
<a href="user/project_new.php">Create new</a>
</p>
<table class="mytable">
	<tr>
		<th>project</th>
		<th>view</th>
		<th>site</th>
		<th>download</th>
		<th>action</th>
	</tr>
<?php foreach( $data['projects'] as $project ){ ?>
	<tr>
		<td><a href="projects/<?php echo $project['id']; ?>"><?php echo htmlspecialchars( $project['name'] ); ?></a></td>
		<td><?php echo $project['view_count']; ?></td>
		<td><?php echo $project['site_count']; ?></td>
		<td><?php echo $project['download_count']; ?></td>
		<td style="text-align: center;">
			<a href="user/project_edit.php?id=<?php echo $project['id']; ?>">edit</a>&nbsp;
			<a href="user/project_updates.php?id=<?php echo $project['id']; ?>">updates</a>&nbsp;
			<a href="user/project_del.php?id=<?php echo $project['id']; ?>">delete</a>
		</td>
	</tr>
<?php } ?>
</table>
<?php
}