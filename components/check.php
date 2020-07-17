<?php
class CCheck
{
	function IsSpam( $msg )
	{
		if( preg_match_all( '/http:/i', $msg, $matches ) > 1 )
		{
			return true;
		}
		if( preg_match( '/<a href/i', $msg ) )
		{
			return true;
		}
		
		return false;
	}
}
?>