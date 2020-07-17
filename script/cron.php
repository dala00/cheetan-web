<?php
	require_once( "../config.php" );
	require_once( "../cheetan/cheetan.php" );
	
function action( &$c )
{
	SaveAmazon( $c );
}


function SaveAmazon( &$c )
{
//	$c->ch_amazon->del( "1=1" );
	$xml	= $c->ch_amazon->ItemSearch( "Books", 492352, "salesrank", 1, "PHP" );
	foreach( $xml["ItemSearchResponse"]["Items"]["Item"] as $item )
	{
		$data			= array();
		$data["url"]	= $item["DetailPageURL"];
		$data["img"]	= $item["SmallImage"]["URL"];
		$data["name"]	= mb_convert_encoding( $item["ItemAttributes"]["Title"], "SJIS", "UTF-8" );
		$data["name"]	= addslashes( $data["name"] );
		$data["price"]	= $item["OfferSummary"]["LowestNewPrice"]["Amount"];
		$data["lang"]	= "";
		$c->ch_amazon->insert( $data );
	}
	$xml	= $c->ch_amazon->ItemSearch( "ForeignBooks", 52033011, "salesrank", 1, "PHP" );
	foreach( $xml["ItemSearchResponse"]["Items"]["Item"] as $item )
	{
		$data			= array();
		$data["url"]	= $item["DetailPageURL"];
		$data["img"]	= $item["SmallImage"]["URL"];
		$data["name"]	= mb_convert_encoding( $item["ItemAttributes"]["Title"], "SJIS", "UTF-8" );
		$data["name"]	= addslashes( $data["name"] );
		$data["price"]	= $item["OfferSummary"]["LowestNewPrice"]["Amount"];
		$data["lang"]	= "eng";
		$c->ch_amazon->insert( $data );
	}
	print "finished.";
}
?>