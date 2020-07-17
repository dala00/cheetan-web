<?php
/*-----------------------------------------------------------------------------
cheetan is licensed under the MIT license.
copyright (c) 2006 cheetan all right reserved.
http://php.cheetan.net/
-----------------------------------------------------------------------------*/
class CDispatch extends CObject
{
	function dispatch( &$data )
	{
		$db			= new CDatabase();
		if( function_exists( "config_database" ) )
		{
			config_database( $db );
		}
		$db->connect();
	
		$sanitize	= new CSanitize();
		$validate	= new CValidate();
		$controller	= new CController();
		$controller->SetDatabase( $db );
		$controller->SetSanitize( $sanitize );
		$controller->SetValidate( $validate );
		if( function_exists( "config_models" ) )
		{
			config_models( $controller );
		}

		$this->_check_secure( $controller );

		if( function_exists( "config_controller" ) )
		{
			config_controller( $controller );
		}
		if( function_exists( "action" ) )
		{
			action( $controller );
		}
		
		$template	= $controller->GetTemplateFile();
		$viewfile	= $controller->GetViewFile();
		$variable	= $controller->GetVariable();
		
		$view		= new CView();
		$view->SetFile( $template, $viewfile );
		$view->SetVariable( $variable );
		$view->SetSanitize( $sanitize );
		$view->display();

		$data		= $variable;
	}


	function _check_secure( $controller )
	{
		if( function_exists( "is_secure" ) )
		{
			if( is_secure( $controller ) )
			{
				if( function_exists( "check_secure" ) )
				{
					check_secure( $controller );
				}
			}
		}
	}
}
?>
