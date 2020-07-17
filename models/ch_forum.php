<?php
class CCh_forum extends CModel
{
	function GetCategories()
	{
		return $this->find( '', 'seq' );
	}
	
	
	function GetCategory( $id )
	{
		return $this->findone( "id=$id" );
	}
}
?>