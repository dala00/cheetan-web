<?php
class CHelper extends CObject
{
	function hidden( $array, $prefix )
	{
		$output	= '';
		foreach( $array as $name => $row )
		{
			$output .= "<input type=\"hidden\" name=\"$prefix$name\" value=\"" . htmlspecialchars( $row ) . '">';
		}
		return $output;
	}
	
	
	function need()
	{
		if( is_english() )	return '<font color="red">(Need)</font>';
		return '<font color="red">（必須）</font>';
	}
}