<?php
class CCh_project extends CModel
{
    var $validatefunc = array(
							"name"			=> "notempty",
							'name_english'	=> 'eisu',
                 	        "description"	=> "notempty",
							 );
	var $validatemsg = array( 
							'name'			=> '名前が入力されていません。<br>',
							'name_english'	=> '英語表記名は半角英数字で入力して下さい。<br>',
							'description'	=> '概要が入力されていません。<br>',
							);
	
	
	function CCh_project()
	{
		if( is_english() )
		{
			$this->validatemsg = array( 
									'name'			=> 'Input name.<br>',
									'name_english'	=> 'Input name_english in English.<br>',
									'description'	=> 'Input description.<br>',
									);
		}
	}
	
	
	function GetProjectsCount( $user_id )
	{
		return $this->getcount( "user_id=$user_id AND deleted=0" );
	}
	
	
	function GetProjects( $user_id, $page, $limit )
	{
		$start	= ( $page - 1 ) * $limit;
		return $this->find( "user_id=$user_id AND deleted=0", 'created DESC', "$start,$limit" );
	}
	
	
	function GetProject( $id )
	{
		$query	= "SELECT ch_project.*, ch_user.name AS username FROM ch_project"
				. " LEFT JOIN ch_user ON ch_user.id=ch_project.user_id"
				;
		$result	= $this->findquery( $query, "ch_project.id=$id AND ch_project.deleted=0" );
		return $result[0];
	}
	
	
	function DelProject( $user_id, $id )
	{
		return $this->updateby( array( 'deleted' => 1 ), "id=$id AND user_id=$user_id" );
	}
	
	
	function point( $id, $name, $sidname, $point = 1 )
	{
		$sid	= session_id();
		$query	= "UPDATE $this->table SET $name=$name+$point, $sidname='$sid' WHERE id=$id AND $sidname!='$sid'";
		return $this->query( $query );
	}
	
	
	function GetRanking( $limit )
	{
		return $this->find( "deleted=0", 'view_count DESC', $limit );
	}
}