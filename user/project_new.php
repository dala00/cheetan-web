<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$errmsg	= '';
	if( count( $_POST ) )
	{
		$user	= $c->auth->islogin();
		$errmsg	.= $c->ch_project->validatemsg( $c->data['Project'] );
		if( $errmsg == '' )
		{
			$c->data['Project']['name']		= stripslashes($c->data['Project']['name']);
			$c->data['Project']['description'] = stripslashes($c->data['Project']['description']);
			$c->data['Project']['user_id']	= $user['id'];
			$c->data['Project']['created']	= $c->ch_project->to_datetime();
			$c->data['Project']['updated']	= $c->ch_project->to_datetime();
			$c->ch_project->insert( $c->data['Project'] );
			$_SESSION['flash']	= is_english() ? 'You created project.' : 'プロジェクトを作成しました。';
			$c->redirect( '/user/projects.php' );
		}
		
		$c->set( 'project', $c->data['Project'] );
	}
	
	$c->set( 'errmsg', $errmsg );
}


function content( $data, &$c )
{
?>
<h1>プロジェクト新規作成</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_new.php">
<label for="Project/name">プロジェクト名<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="Project/name" value="<?php echo htmlspecialchars( $data['project']['name'] ); ?>" size="50"><br>
<label for="Project/name_english">プロジェクト名（英語表記）<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="Project/name_english" value="<?php echo htmlspecialchars( $data['project']['name_english'] ); ?>" size="50"><br>
<label for="Project/description">概要<?php echo $c->helper->need(); ?></label><br>
<script type="text/javascript" src="/js/fckeditor.js"></script>
<script type="text/javascript">
<!--
var oFCKeditor			= new FCKeditor( 'Project/description' ) ;
oFCKeditor.BasePath		= '/js/';
oFCKeditor.Height		= 500 ;
oFCKeditor.Value		= '<?php echo str_replace( array( "\r", "\n" ), '', str_replace( "'", "\\'", $data['project']['description'] ) ); ?>' ;
oFCKeditor.ToolbarSet	= 'Cheetan';
oFCKeditor.Create() ;
//-->
</script>
<label for="Project/site_url">サイトURL</label><br>
<input type="text" name="Project/site_url" value="<?php echo htmlspecialchars( $data['project']['site_url'] ); ?>" size="50"><br>
<label for="Project/demo_url">デモURL</label><br>
<input type="text" name="Project/demo_url" value="<?php echo htmlspecialchars( $data['project']['demo_url'] ); ?>" size="50"><br>
<label for="Project/download_url">ダウンロードURL<font color="red">（直リンクの場合リンク先の許可を得ること）</font></label><br>
<input type="text" name="Project/download_url" value="<?php echo htmlspecialchars( $data['project']['download_url'] ); ?>" size="50"><br>
<input type="submit" value="作成" onclick="if( !confirm( 'この内容で作成します。よろしいですか？' ) ) return false;">
</form>
<?php
}


function content_eng( $data )
{
?>
<h1>New project</h1>
<font color="red"><?php echo $data['errmsg']; ?></font>
<form method="post" action="user/project_new.php">
<label for="Project/name">Project name<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="Project/name" value="<?php echo htmlspecialchars( $data['project']['name'] ); ?>" size="50"><br>
<label for="Project/name_english">Project name(in English)<?php echo $c->helper->need(); ?></label><br>
<input type="text" name="Project/name_english" value="<?php echo htmlspecialchars( $data['project']['name_english'] ); ?>" size="50"><br>
<label for="Project/description">Description<?php echo $c->helper->need(); ?></label><br>
<script type="text/javascript" src="/js/fckeditor.js"></script>
<script type="text/javascript">
<!--
var oFCKeditor			= new FCKeditor( 'Project/description' ) ;
oFCKeditor.BasePath		= '/js/';
oFCKeditor.Height		= 500 ;
oFCKeditor.Value		= '<?php echo str_replace( array( "\r", "\n" ), '', str_replace( "'", "\\'", $data['project']['description'] ) ); ?>' ;
oFCKeditor.ToolbarSet	= 'Cheetan';
oFCKeditor.Create() ;
//-->
</script>
<label for="Project/site_url">Site URL</label><br>
<input type="text" name="Project/site_url" value="<?php echo htmlspecialchars( $data['project']['site_url'] ); ?>" size="50"><br>
<label for="Project/demo_url">Demo URL</label><br>
<input type="text" name="Project/demo_url" value="<?php echo htmlspecialchars( $data['project']['demo_url'] ); ?>" size="50"><br>
<label for="Project/download_url">Download URL</label><br>
<input type="text" name="Project/download_url" value="<?php echo htmlspecialchars( $data['project']['download_url'] ); ?>" size="50"><br>
<input type="submit" value="Create" onclick="if( !confirm( 'Create OK ?' ) ) return false;">
</form>
<?php
}