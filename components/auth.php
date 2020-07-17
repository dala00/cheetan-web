<?php
class CAuth extends CObject
{
	function login( $user )
	{
		if( !$this->islogin() )
		{
			$_SESSION['user']	= $user;
		}
	}
	
	
	function islogin()
	{
		return empty( $_SESSION['user'] ) ? null : $_SESSION['user'];
	}
	
	
	function logout()
	{
		if( $this->islogin() )
		{
			unset( $_SESSION['user'] );
		}
	}
	
	
	function update( $user )
	{
		if( $this->islogin() )
		{
			$_SESSION['user']	= $user;
		}
	}
}