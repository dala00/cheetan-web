<?php
require_once( "script/xml.php" );

class CCh_amazon extends CModel
{
	var $name			= 'con2';
	var $host			= "webservices.amazon.co.jp";
	var $base_path		= "/onca/xml?Service=AWSECommerceService";
	var $sub_id			= "";
	var $secretKey = '';
	var $aid			= "";
	var $version		= "2009-01-06";
	var $contentType	= "text/xml";
	

	function BrowseNodeList( $node )
	{
		$vars					= array();
		$vars["Operation"]		= "BrowseNodeLookup";
		$vars["BrowseNodeId"]	= $node;
		return $this->_LoadXML( $vars );
	}
	
	
	function ItemSearch( $index, $id, $sort, $page, $keyword = "" )
	{
		$vars					= array();
		$vars["Operation"]		= "ItemSearch";
		$vars["ResponseGroup"]	= "Large";
		$vars["SearchIndex"]	= $index;
		$vars["ItemPage"]		= $page;
		if( $keyword )
		{
			$vars["Keywords"]		= mb_convert_encoding( $keyword, "UTF-8", "auto" );
		}
		if( $index != "Blended" )
		{
			$vars["BrowseNode"]		= $id;
			$vars["Sort"]			= $sort;
		}
		return $this->_LoadXML( $vars );
	}
	
	
	function ItemLookup( $asin )
	{
		$vars					= array();
		$vars["Operation"]		= "ItemLookup";
		$vars["ResponseGroup"]	= "Large";
		$vars["IdType"]			= "ASIN";
		$vars["ItemId"]			= $asin;
		return $this->_LoadXML( $vars );
	}
	
	
	function InitSearchItem( $items )
	{
		$ret		= array();
		foreach( $items as $item )
		{
			if( !$this->IsAdult( $item ) )
			{
				array_push( $ret, $item );
			}
		}
		
		return $ret;
	}
	
	
	function IsAdult( $item )
	{
		if( !empty( $item["ItemAttributes"]["Format"] ) )
		{
			if( strstr( mb_convert_encoding( $item["ItemAttributes"]["Format"], "EUC-JP", "UTF-8" ), "\¢\A\e\E" ) !== false )
			{
				return true;
			}
		}
		
		return false;
	}
	
	
	function GetRank( $limit )
	{
		return $this->findAll( null, null, "rank", $limit );
	}
	
	
	function _LoadXML( $vars )
	{
		$path	= $this->base_path
				. "&AWSAccessKeyId=" . $this->sub_id
				. "&Version=" . $this->version
				. "&ContentType=" . $this->contentType;
		foreach( $vars as $key => $val )
		{
			$path	.= "&$key=$val";
		}
		$parsedUrl = parse_url($path);
		parse_str($parsedUrl['query'], $parsedQuery);
		$parsedQuery['Timestamp'] = gmdate('Y-m-d') . 'T' . gmdate('H:i:s') . 'Z';
		ksort($parsedQuery);
		$parts = array();
		foreach ($parsedQuery as $key => $value) {
			$parts[] = "$key=" . rawurlencode($value);
		}
		$original = "GET\n" . $this->host . "\n" . $parsedUrl['path'] . "\n";
		$parameters = join('&', $parts);
		$original .= $parameters;
		$signature = base64_encode(hash_hmac('sha256', $original, $this->secretKey, true));
		$parameters .= "&Signature=" . rawurlencode($signature);
		$path = $parsedUrl['path'] . "?$parameters";

		if( $doc = $this->_connect( $path ) )
		{
			if( substr( $doc, 0, 5 ) == "<?xml" )
			{
				return XML_unserialize( $doc );
			}
		}
		
		return FALSE;		
	}
	
	
	function _connect( $path )
	{
		$sockPointer = @fsockopen( $this->host, 80, $errno, $errstr, 6 ); 
		if( !$sockPointer )
		{
			return FALSE;
		}
		else
		{
			@stream_set_timeout( $sockPointer, 6, 0 );
			fputs ($sockPointer, "GET $path HTTP/1.0\r\nHost: $this->host\r\n\r\n");
			fputs ($sockPointer, "User-Agent: ECS-Sample/1.0\n\n");
			fputs ($sockPointer, "Keep-Alive: 300\n\n");
			fputs ($sockPointer, "Connection: Keep-Alive\n\n");
			fputs ($sockPointer, "Referer: http://php.cheetan.net/\n\n");
			
			$buf = "";
			$response = @fgets($sockPointer);
			if (substr_count($response, "200 OK") > 0) 
			{
				while (!feof($sockPointer))
				{
					$buf = $buf . @fread($sockPointer,4096);
				}
			}
			else
			{
				$result = FALSE;
			}

			$result = TRUE;
		}
		
		fclose($sockPointer);

		if ($result)
		{
			$doc = substr($buf,strpos($buf,"\r\n\r\n")+4);
			return $doc;
		}
		else
		{
			return FALSE;
		}
	}
}
?>