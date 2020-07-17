<?php
class CCh_user extends CModel
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
	
	
	function CCh_user()
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
	
	
	function get( $id )
	{
		return $this->findone( "id=$id" );
	}
	
	
	function FindByEmail( $email )
	{
		return $this->findone( "email='$email'" );
	}
	
	
	function is_duplicate( $id, $email )
	{
		return $this->findone( "id!=$id AND email='$email'" );
	}
	
	
	function TmpuserToUser( $tmpuser )
	{
		$user	= array(
			'name'		=> $tmpuser['name'],
			'email'		=> $tmpuser['email'],
			'password'	=> $tmpuser['password'],
			'created'	=> $this->to_datetime(),
			);
		return $this->insert( $user );
	}
	
	
	function FindLogin( $data )
	{
		return $this->findone( "email='{$data['email']}' AND password='{$data['password']}'" );
	}
}
