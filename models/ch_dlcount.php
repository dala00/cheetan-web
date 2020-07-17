<?php
class CCh_dlcount extends CModel
{
	function add( $filename )
	{
		$data["filename"]	= $filename;
		$this->insert( $data );
	}
}
?>