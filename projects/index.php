<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$projects	= $c->ch_project->find( "", "created DESC" );
	$c->set( 'projects', $projects );
}


function content( $data, &$c )
{
?>
<h1>プロジェクト</h1>

<table class="mytable">
	<tr>
		<th style="width:130px;">プロジェクト</th>
		<th>概要</th>
		<th width="50">アクセス</th>
		<th width="80">登録日</th>
	</tr>
<?php foreach( $data['projects'] as $project ){ ?>
	<tr>
		<td><a href="projects/<?php echo $project['id']; ?>"><?php echo htmlspecialchars( $project['name'] ); ?></a></td>
		<td><?php echo substr( strip_tags( $project['description'] ), 0, 120); ?></td>
		<td style="text-align:center"><?php echo $project['view_count']; ?></td>
		<td style="text-align:center"><?php echo substr( $project['created'], 0, 10 ); ?></td>
	</tr>
<?php } ?>
</table>
<?php
}


function content_eng( $data )
{
?>
<h1>Project</h1>

<table class="mytable">
	<tr>
		<th style="width:130px;">Project</th>
		<th>Description</th>
		<th width="50">Access</th>
		<th width="80">Created</th>
	</tr>
<?php foreach( $data['projects'] as $project ){ ?>
	<tr>
		<td><a href="projects/<?php echo $project['id']; ?>"><?php echo htmlspecialchars( $project['name_english'] ); ?></a></td>
		<td><?php echo substr( strip_tags( $project['description'] ), 0, 120); ?></td>
		<td style="text-align:center"><?php echo $project['view_count']; ?></td>
		<td style="text-align:center"><?php echo substr( $project['created'], 0, 10 ); ?></td>
	</tr>
<?php } ?>
</table>
<?php
}