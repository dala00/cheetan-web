<?php
define('ROOT', realpath(__DIR__));
define( 'CURDIR', basename( dirname( $_SERVER["SCRIPT_FILENAME"] ) ) );
define( 'CURFILE', basename( $_SERVER['SCRIPT_FILENAME'] ) );

define( 'PAGE_DISP_NUM', 10 );
define( 'ENABLE_TAGS', '<a><div><li><b><i><string><span><h1><h2><h3><h4><h5><h6><hr><p><br><pre><center><blockquote><address><font><tt><u><s><strike><big><small><sub><sup><em><code><samp><kbd><var><cite><ul><ol><dl><dt><dd><table><th><tr><td><caption><a><image><map><area>' );

define( 'ADMIN_EMAIL', 'cheetan@php.cheetan.net' );

require_once ROOT . '/vendor/autoload.php';

mb_language( 'japanese' );


function is_english()
{
	if( $_SERVER["HTTP_HOST"] == "phpeng.cheetan.net" )	return true;
	return false;
}


function config_database( &$db )
{
}


function config_models( &$controller )
{
	$controller->AddModel( dirname(__FILE__) . "/models/ch_dlcount.php" );
	// $controller->AddModel( dirname(__FILE__) . "/models/ch_amazon.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_forum.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_forumdata.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_user.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_tmpuser.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_project.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/ch_project_update.php" );
	$controller->AddModel( dirname(__FILE__) . "/models/texttest.php" );
//	$controller->AddModel( dirname(__FILE__) . '/models/cheetan_session.php' );
}


function config_components( &$c )
{
	$c->AddComponent( dirname(__FILE__) . '/components/mail.php' );
	$c->AddComponent( dirname(__FILE__) . '/components/check.php' );
	$c->AddComponent( dirname(__FILE__) . '/components/helper.php' );
	$c->AddComponent( dirname(__FILE__) . '/components/auth.php' );
	$c->AddComponent( dirname(__FILE__) . '/components/page.php' );
	
	$c->AddComponent( dirname(__FILE__) . '/components/javascript.php' );
	$c->AddComponent( dirname(__FILE__) . '/components/prototype.php' );
}


function config_controller( &$c )
{
	if( isdebug() )
	{
		$c->SetDebug( true );
	}
	
	if( is_english() )
	{
		$c->SetTemplateFile( dirname(__FILE__) . "/template_e.html" );
		$amazons	= [];
		$link_ja	= '<a href="http://php.cheetan.net' . $_SERVER["REQUEST_URI"] . '">Japanese</a>';
		$link_en	= "English";
	}
	else
	{
		$c->SetTemplateFile( dirname(__FILE__) . "/template.html" );
		$amazons	= [];
		$link_ja	= 'Japanese';
		$link_en	= '<a href="http://phpeng.cheetan.net' . $_SERVER["REQUEST_URI"] . '">English</a>';
	}
	$c->set( "amazons", $amazons );
	$c->set( 'project_ranking', [] );
	$c->set('project_new', []);
	$c->set( "link_ja", $link_ja );
	$c->set( "link_en", $link_en );
}


if( !function_exists( 'is_secure' ) )
{
	function is_secure()
	{
		if( in_array( CURDIR, array( 'user' ) ) )
		{
			return true;
		}
		return false;
	}
}


function check_secure( &$c )
{
	if( !$c->auth->islogin() )
	{
		$c->redirect( '/user/login.php' );
	}
}


function after_render( &$c )
{
	$_SESSION['flash']	= '';
}


function mysanitize( $str )
{
//	$str	= stripslashes( $str );
	//$str	= str_replace( "'", "\\'", $str );
	return $str;
}


function pr( $data )
{
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}


function h( $str )
{
	return htmlspecialchars( $str );
}


function isdebug()
{
	return ( $_SERVER['REMOTE_ADDR'] == '202.238.80.65' ) ? true : false;
}


function mysep( $str, $size = 4 )
{
	$len	= mb_strlen( $str );
	$result	= array();
	for( $i = 0; $i < $len; $i += $size )
	{
		$result[] = mb_substr( $str, $i, $size );
	}
	return $result;
}
?>