<?php
require_once( 'Smarty.class.php' );	


class CSmartyController extends CController
{
	var $smarty			= null;
	var $viewfile_ext	= ".tpl";


    function CSmartyController()
    {
        $this->smarty = new Smarty;
    }

    function set( $key, $value )
    {
        $this->smarty->assign( $key, $value );
    }
}