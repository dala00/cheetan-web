<?php
class CCh_tmpuser extends CModel
{
    var $validatefunc = array(
							"name"		=> "notempty",
                 	        "email"		=> "email",
							'password'	=> 'notempty',
							 );
	var $validatemsg = array( 
							'name'		=> '名前が入力されていません。<br>',
							'email'		=> 'メールアドレスが入力されていません。<br>',
							'password'	=> 'パスワードが入力されていません。<br>',
							);
	
	
	function CCh_tmpuser()
	{
		if( is_english() )
		{
			$this->validatemsg	= array(
							'name'		=> 'Input name.<br>',
							'email'		=> 'Input email.<br>',
							'password'	=> 'Input password.<br>',
								);
		}
	}
	
	
	function get( $id, $sid )
	{
		return $this->findone( "id=$id AND sid='$sid'" );
	}
	
	
	function DelById( $id )
	{
		$this->del( "id=$id" );
	}
}
