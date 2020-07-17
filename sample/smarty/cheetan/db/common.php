<?php
/*-----------------------------------------------------------------------------
cheetan is licensed under the MIT license.
copyright (c) 2006 cheetan all right reserved.
http://php.cheetan.net/
-----------------------------------------------------------------------------*/
class CDBCommon extends CObject
{
	var $last_insert_id	= null;
	var $affected_rows	= null;
	var $last_query		= null;
	var $last_error		= null;
	var $query_time		= null;
	var $sqllog			= array();


	function connect( $host, $user, $pswd, $db )
	{
		return false;
	}
	
	
	function query( $query, $connect )
	{
		return false;
	}
	
	
	function find( $query, $connect )
	{
		return array();
	}
	
	
	function count( $query, $connect )
	{
		return 0;
	}
	
	
	function GetFindQuery( $query, $condition = "", $order = "", $limit = "", $group = "" )
	{
		if( $condition )	$query .= " WHERE $condition";
		if( $group )		$query .= " GROUP BY $group";
		if( $order )		$query .= " ORDER BY $order";
		if( $limit )		$query .= " LIMIT $limit";
		return $query;
	}
	
	
	function findquery( $connect, $query, $condition = "", $order = "", $limit = "", $group = "" )
	{
		$query	= $this->GetFindQuery( $query, $condition, $order, $limit, $group );
		return $this->find( $query, $connect );
	}
	
	
	function findall( $connect, $table, $condition = "", $order = "", $limit = "", $group = "" )
	{
		$query	= "SELECT * FROM $table ";
		$query	= $this->GetFindQuery( $query, $condition, $order, $limit, $group );
		return $this->find( $query, $connect );
	}
	
	
	function getcount( $connect, $table, $condition = "", $limit = "" )
	{
		$query	= "SELECT * FROM $table ";
		$query	= $this->GetFindQuery( $query, $condition, "", $limit );
		return $this->count( $query, $connect );
	}
	
	
	function insert( $table, $datas, $connect )
	{
		$count	= count( $datas );
		$query	= "INSERT INTO $table(";
		$i		= 0;
		foreach( $datas as $key => $data )
		{
			$query .= "`$key`";
			if( $i < $count - 1 )
			{
				$query .= ",";
			}
			$i++;
		}
		$query	.= ") VALUES(";
		$i		= 0;
		foreach( $datas as $key => $data )
		{
			$query .= "'$data'";
			if( $i < $count - 1 )
			{
				$query .= ",";
			}
			$i++;
		}
		$query	.= ")";
		return $this->query( $query, $connect );
	}
	
	
	function update( $table, $datas, $condition, $connect )
	{
		$count	= count( $datas );
		$query	= "UPDATE $table SET ";
		$i		= 0;
		foreach( $datas as $key => $data )
		{
			$query .= "`$key`='$data'";
			if( $i < $count - 1 )
			{
				$query .= ",";
			}
			$i++;
		}
		$query	.= " WHERE $condition";
		return $this->query( $query, $connect );
	}
	
	
	function del( $table, $condition, $connect )
	{
		$query	= "DELETE FROM $table WHERE $condition";
		return $this->query( $query, $connect );
	}
	
	
	function CreateCondition( $field, $value )
	{
		return "`$field`='$value'";
	}
	
	
	function escape( $str )
	{
		return $str;
	}
	
	
	function GetLastInsertId()
	{
		return $this->last_insert_id;
	}
	
	
	function GetAffectedRows()
	{
		return $this->affected_rows;
	}
	
	
	function GetLastError()
	{
		return $this->last_error;
	}
	
	
	function _push_log()
	{
		$log['last_insert_id']	= $this->last_insert_id;
		$log['affected_rows']	= $this->affected_rows;
		$log['query']			= $this->last_query;
		$log['error']			= $this->last_error;
		$log['query_time']		= $this->query_time;
		array_push( $this->sqllog, $log );
	}
	
	
	function GetSqlLog()
	{
		return $this->sqllog;
	}
}
?>