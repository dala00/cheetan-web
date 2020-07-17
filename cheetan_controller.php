<?php
class CCheetanController extends CController
{
	function RequestHandle()
	{
		$this->RequestSanitize( $_GET );
		$this->RequestSanitize( $_POST );
		$this->RequestSanitize( $_REQUEST );
		CController::RequestHandle();
	}
	
	
	function RequestSanitize( &$request )
	{
		foreach( $request as $i => $row )
		{
			$request[$i]	= stripslashes( $row );
			$request[$i]	= str_replace( "'", "\\'", $row );
		}
	}
}
?>