<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$project	= $c->ch_project->GetProject( $_GET['id'] );
	if( !$project )	exit;
	$c->ch_project->point( $_GET['id'], 'view_count', 'lastsid' );
	$updates	= $c->ch_project_update->GetProjectUpdates( $_GET['id'] );
	$c->set( 'project', $project );
	$c->set( 'updates', $updates );
	$c->set( 'page_title', is_english() ? $project['name_english'] : $project['name'] );
}


function content( $data, &$c )
{
?>
<h1><?php echo htmlspecialchars( $data['project']['name'] ); ?></h1>
<div align="right" style="margin-bottom:20px;">
	作成者：<a href="user/<?php echo $data['project']['user_id']; ?>"><?php echo htmlspecialchars( $data['project']['username'] ); ?></a>&nbsp;&nbsp;
	登録日：<?php echo substr( $data['project']['created'], 0, 10 ); ?>
</div>
<p>
<?php echo strip_tags( $data['project']['description'], ENABLE_TAGS ); ?>
</p>
<p>
<?php if( $data['project']['site_url'] ){ ?>
	<a href="projects/tourl.php?id=<?php echo $data['project']['id']; ?>">公式サイト</a><br>
<?php } ?>
<?php if( $data['project']['demo_url'] ){ ?>
	<a href="projects/todemo.php?id=<?php echo $data['project']['id']; ?>">デモページ</a><br>
<?php } ?>
<?php if( $data['project']['download_url'] ){ ?>
	<a href="projects/download.php?id=<?php echo $data['project']['id']; ?>">ダウンロード</a><br>
<?php } ?>
</p>
<?php if( $data['updates'] ){ ?>
	<h3>更新情報</h3>
	<?php foreach( $data['updates'] as $update ){ ?>
		<p>
		<?php echo substr( $update['created'], 0, 10 ); ?>&nbsp;<?php echo h( $update['name'] ); ?><br>
		<?php echo str_replace( "\n", '<br>', $update['body'] ); ?>
		</p>
	<?php } ?>
<?php } ?>
<?php
}


function content_eng( $data )
{
?>
<h1><?php echo htmlspecialchars( $data['project']['name_english'] ); ?></h1>
<div align="right" style="margin-bottom:20px;">
	Creator:<a href="user/<?php echo $data['project']['user_id']; ?>"><?php echo htmlspecialchars( $data['project']['username'] ); ?></a>&nbsp;&nbsp;
	Created:<?php echo substr( $data['project']['created'], 0, 10 ); ?>
</div>
<p>
<?php echo strip_tags( $data['project']['description'], ENABLE_TAGS ); ?>
</p>
<p>
<?php if( $data['project']['site_url'] ){ ?>
	<a href="projects/tourl.php?id=<?php echo $data['project']['id']; ?>">Project site</a><br>
<?php } ?>
<?php if( $data['project']['demo_url'] ){ ?>
	<a href="projects/todemo.php?id=<?php echo $data['project']['id']; ?>">Demo page</a><br>
<?php } ?>
<?php if( $data['project']['download_url'] ){ ?>
	<a href="projects/download.php?id=<?php echo $data['project']['id']; ?>">Download</a><br>
<?php } ?>
</p>
<?php
}