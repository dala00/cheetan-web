<?php
class CCh_forumdata extends CModel
{
	var $validatefunc	= array(
							'name' => 'notempty',
							'title' => 'notempty',
							'body' => 'notempty',
							'password' => 'notempty',
							);
	var $validatemsg	= array(
							'name' => '名前が入力されていません。<br>',
							'title' => 'タイトルが入力されていません。<br>',
							'body' => '内容が入力されていません。<br>',
							'password' => 'パスワードが入力されていません。<br>'
							);
							
	function CCh_forumdata()
	{
		if( is_english() )
		{
			$this->validatemsg	= array(
								'name' => 'Input name.<br>',
								'title' => 'Input title.<br>',
								'body' => 'Input body.<br>',
								'password' => 'Input password<br>'
								);
		}
	}
							

	function getall( $cid, $limit = '' )
	{
		$query	= "SELECT p.*, count(c.id) as count FROM $this->table p"
				. " LEFT JOIN $this->table c ON p.id=c.parent";
		return $this->findquery( $query, "p.cid=$cid and p.parent=-1", 'p.modified DESC', $limit, 'p.id' );
	}
	
	
	function gettopic( $id )
	{
		return $this->findone( "id=$id and parent=-1" );
	}
	
	
	function gettopicbyid( $id )
	{
		return $this->findone( "id=$id" );
	}
	
	
	function getchild( $id )
	{
		return $this->find( "parent=$id", 'created' );
	}
	
	
	function getchildbyid( $parent, $id )
	{
		return $this->findone( "parent=$parent and id=$id" );
	}
	
	
	function UpdateModified( $id )
	{
		$data				= array();
		$data['id']			= $id;
		$data['modified']	= $this->to_datetime( time() );
		return $this->update( $data );
	}
	
	
	function delete( $id )
	{
		$this->del( "id=$id" );
		$this->del( "parent=$id" );
	}
	
	
	function validatemsg( &$data )
	{
		return parent::validatemsg( $data );
	}
}
?>