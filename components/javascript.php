<?php
class CJavascript extends CObject
{
	function codeBlock( $script = null, $safe = false )
	{
		$block	= ( $script !== null );
		if( $safe )
		{
			$script	= "//<![CDATA[\n" . $script;
			if( $block )
			{
				$script	.= "\n//]]>";
			}
		}
		
		$script	= '<script type="text/javascript">' . $script;
		if( $block )
		{
			$script .= '</script>';
		}
		return $script;
	}
	
	
	function blockEnd( $safe = false )
	{
		$tag	= '';
		if( $safe )
		{
			$tag .= "\n//]]>";
		}
		$tag	.= '</script>';
		return $tag;
	}
	
	
	function link( $url )
	{
		if( is_array( $url ) )
		{
			$tag	= '';
			foreach( $url as $row )
			{
				$tag .= $this->link( $row );
			}
			return $tag;
		}
		if( strpos( $url, '.js' ) === false && strpos( $url, '?' ) === false )
		{
			$url .= '.js';
		}
		
		return '<script type="text/javascript" src="' . $url . '"></script>';
	}
	
	
	function escapeScript( $script )
	{
		$script = str_replace( array( "\r\n", "\n", "\r" ), '\n', $script );
		$script = str_replace( array( '"', "'" ), array( '\"', "\\'" ), $script );
		return $script;
	}


	function escapeString( $string )
	{
		$escape = array( "\r\n" => '\n', "\r" => '\n', "\n" => '\n', '"' => '\"', "'" => "\\'" );
		return str_replace( array_keys( $escape ), array_values( $escape ), $string );
	}
	
	
	function event( $object, $event, $observer = null, $useCapture = false )
	{
		$useCapture	= $useCapture ? 'true' : 'false';

		if( strpos( $object, 'window' ) !== false ||
			strpos( $object, 'document' ) !== false ||
			strpos($object, '$(') !== false ||
			strpos($object, '"') !== false ||
			strpos($object, '\'') !== false )
		{
			$b = "Event.observe({$object}, '{$event}', function(event){ {$observer} }, {$useCapture});";
		}
		elseif( strpos( $object, '\'' ) === 0 )
		{
			$b = "Event.observe(" . substr( $object, 1 ) . ", '{$event}', function(event){ {$observer} }, {$useCapture});";
		}
		else
		{
			$chars = array( '#', ' ', ', ', '.', ':' );
			$found = false;
			foreach( $chars as $char )
			{
				if( strpos( $object, $char ) !== false )
				{
					$found = true;
					break;
				}
			}
			if( $found )
			{
				$this->_rules[$object] = $event;
			}
			else
			{
				$b = "Event.observe(\$('{$object}'), '{$event}', function(event){ {$observer} }, {$useCapture});";
			}
		}

		if (isset($b) && !empty($b)) {
			return $this->codeBlock( $b );
		}
	}
}