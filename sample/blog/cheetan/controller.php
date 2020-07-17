<?php
/*-----------------------------------------------------------------------------
cheetan is licensed under the MIT license.
copyright (c) 2006 cheetan all right reserved.
http://php.cheetan.net/
-----------------------------------------------------------------------------*/
class CController extends CObject
{
	var	$template		= null;
	var $viewfile		= null;
	var $viewfile_ext	= ".html";
	var $variables		= array();
	var	$db;
	var $sanitize;
	var $s;
	var	$validate;
	var	$v;
	//	Model Array
	var $m				= array();
	var	$post			= array();
	var	$get			= array();
	var	$request		= array();
	var	$data			= array();
	
	
	function CController()
	{
		$this->RequestHandle();
	}
	
	
	function AddModel( $path, $name = "" )
	{
		$cname	= basename( $path, ".php" );
		$cname	= strtolower( $cname );
		if( !$name )	$name = $cname;
		$cname	= "C" . ucfirst( $name );
		if( !file_exists( $path ) )
		{
			print "Model File $path is not exist.";
		}
		else
		{
			require_once( $path );
			eval( '$class = new ' . $cname . '();' );
			if( !$class->table )	$class->table = $name;
			$class->SetController( $this );
			$this->m[$name]	= $class;
			if( empty( $this->{$name} ) )	$this->{$name} = &$this->m[$name];
		}
	}
	
	
	function SetTemplateFile( $template )
	{
		$this->template	= $template;
	}
	
	
	function SetViewFile( $viewfile )
	{
		$this->viewfile	= $viewfile;
	}
	
	
	function GetTemplateFile()
	{
		return $this->template;
	}
	
	
	function GetViewFile()
	{
		if( $this->viewfile )
		{
			return $this->viewfile;
		}
		
		$pos	= strpos( SCRIPTFILE, "." );
		if( $pos === FALSE )	return SCRIPTFILE . $this->viewfile_ext;
		if( !$pos )				return $this->viewfile_ext;
		
		list( $title, $ext )	= explode( ".", SCRIPTFILE );
		return $title . $this->viewfile_ext;
	}
	
	
	function set( $name, $value )
	{
		$this->variables[$name]	= $value;
	}
	
	
	function setarray( $datas )
	{
		foreach( $datas as $key => $data )
		{
			$this->set( $key, $data );
		}
	}


	function redirect( $url, $is301 = FALSE )
	{
		if( $is301 )
		{
			header( "HTTP/1.1 301 Moved Permanently" );
		}
		header( "Location: " . $url );
		exit();
	}
	
	
	function RequestHandle()
	{
		if( count( $_GET ) )		$this->get = $_GET;
		if( count( $_POST ) )		$this->post = $_POST;
		if( count( $_REQUEST ) )	$this->request = $_REQUEST;
		$this->ModelItemHandle( $_GET );
		$this->ModelItemHandle( $_POST );
	}
	
	
	function ModelItemHandle( $requests )
	{
		foreach( $requests as $key => $request )
		{
			if( strpos( $key, "/" ) !== FALSE )
			{
				list( $model, $element )		= explode( "/", $key );
				$this->data[$model][$element]	= $request;
			}
		}
	}
	
	
	function GetVariable()
	{
		return $this->variables;
	}
	
	
	function GetDatabase()
	{
		return $this->db;
	}
	
	
	function SetDatabase( $db )
	{
		$this->db	= &$db;
	}


	function SetSanitize( $sanitize )
	{
		$this->sanitize	= $sanitize;
		$this->s		= &$this->sanitize;
	}


	function SetValidate( $validate )
	{
		$this->validate	= $validate;
		$this->v		= &$this->validate;
	}
}
?>
