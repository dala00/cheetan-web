<?php
class CSmartyView extends CView
{
	function display()
	{
		$viewfile	= $this->controller->GetViewFile();
		$contents	= $this->controller->smarty->fetch( $viewfile );
		$this->controller->smarty->assign( 'contents', $contents );
		$this->controller->smarty->display( $this->template );
	}
}