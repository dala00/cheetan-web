<?php
	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
}


function content( $data )
{
?>
<h1>マイページ</h1>

<a href="user/projects.php">プロジェクト一覧</a>
<?php
}


function content_eng( $data )
{
?>
<h1>My page</h1>

<a href="user/projects.php">Project list</a>
<?php
}