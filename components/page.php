<?php
class CPage extends CObject
{
	var $display	= null;


	function pager( $total, $page = null, $path = '', $filename = '' )
	{
		$params	= array(
				"mode"			=> "Sliding",
				"perPage"		=> PAGE_DISP_NUM,
				"delta"			=> 5,
				"totalItems"	=> $total,
				);
		if( $page !== null )
		{
			$params['currentPage']	= $page;
		}
		if( $path || $filename )
		{
			$params['append']	= false;
			$params['path']		= $path;
			$params['fileName']	= $filename ? $filename : '%d.html';
			$params['urlVar']	= 'page';
		}
		$pager			= &Pager::factory( $params );
		$data			= $pager->getPageData();
		$links			= $pager->getLinks();
		$this->display	= $links['all'];
		return $pager->getCurrentPageID();
	}
	
	
	function display( $display = null )
	{
		if( $display )
		{
			echo $display;
		}
		else
		{
			if( $this->display )	echo $this->display;
		}
	}
}