<?php
class CCh_project_update extends CModel
{
    var $validatefunc = array(
							"name"	=> "notempty",
                 	        "body"	=> "notempty",
							 );
	var $validatemsg = array( 
							'name'	=> 'タイトルが入力されていません。<br>',
							'body'	=> '内容が入力されていません。<br>',
							);
	
	
	function CCh_project()
	{
		if( is_english() )
		{
			$this->validatemsg = array( 
									'name'	=> 'Input name.<br>',
									'body'	=> 'Input body.<br>',
									);
		}
	}
	
	
	function GetProjectUpdatesCount( $project_id )
	{
		return $this->getcount( "project_id=$project_id" );
	}
	
	
	function GetProjectUpdates( $project_id, $page = '', $limit = '' )
	{
		if( $page && $limit )
		{
			$start	= ( $page - 1 ) * $limit;
			$l	= "$start,$limit";
		}
		else
		{
			$l	= '';
		}
		return $this->find( "project_id=$project_id", "created DESC", $l );
	}
	
	
	function get( $id, $user_id )
	{
		$sql	= "SELECT ch_project_update.* FROM ch_project_update"
				. " LEFT JOIN ch_project ON ch_project.id=ch_project_update.project_id"
				;
		$result	= $this->findquery( $sql, "ch_project_update.id=$id AND ch_project.user_id=$user_id" );
		return $result[0];
	}
	
	
	function DelUpdate( $id )
	{
		return $this->del( "id=$id" );
	}
}