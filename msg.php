<?php
	require_once( "config.php" );
	require_once( "cheetan/cheetan.php" );


function content( $data )
{
?>
<?php echo $_GET['msg']; ?><br>
<a href="<?php echo $data['url'] ? $_GET['url'] : '/'; ?>">戻る</a>
<?php
}