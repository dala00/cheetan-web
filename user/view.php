<?php
function is_secure()
{
	return false;
}


	require_once( '../config.php' );
	require_once( '../cheetan/cheetan.php' );


function action( &$c )
{
	$user	= $c->ch_user->get( $_GET['id'] );
	if( !$user )	exit;
	$c->set( 'user', $user );
}


function content( $data, &$c )
{
?>
<h1><?php echo htmlspecialchars( $data['user']['name'] ); ?>さん</h1>
<div align="right" style="margin-bottom:20px;">
	登録日：<?php echo substr( $data['user']['created'], 0, 10 ); ?>
</div>
<p>
<?php echo str_replace( "\n", '<br>', htmlspecialchars( $data['user']['intro'] ) ); ?>
</p>
<p>
<?php if( $data['user']['url'] ){ ?>
	<a href="<?php echo htmlspecialchars( $data['user']['url'] ); ?>">サイト</a><br>
<?php } ?>
</p>
<?php
}


function content_eng( $data )
{
?>
<h1><?php echo htmlspecialchars( $data['user']['name'] ); ?></h1>
<div align="right" style="margin-bottom:20px;">
	Registed:<?php echo substr( $data['user']['created'], 0, 10 ); ?>
</div>
<p>
<?php echo str_replace( "\n", '<br>', htmlspecialchars( $data['user']['intro'] ) ); ?>
</p>
<p>
<?php if( $data['user']['url'] ){ ?>
	<a href="<?php echo htmlspecialchars( $data['user']['url'] ); ?>">Site</a><br>
<?php } ?>
</p>
<?php
}