<?php
class CPrototype extends CJavascript
{
	var $ajaxOptions = array( 'type', 'confirm', 'condition', 'before', 'after', 'fallback', 'update', 'loading', 'loaded', 'interactive', 'complete', 'with', 'url', 'method', 'position', 'form', 'parameters', 'evalScripts', 'asynchronous', 'onComplete', 'onUninitialized', 'onLoading', 'onLoaded', 'onInteractive', 'success', 'failure', 'onSuccess', 'onFailure', 'insertion', 'requestHeaders', 'indicator' );
	var $callbacks = array( 'uninitialized', 'loading', 'loaded', 'interactive', 'complete', 'success', 'failure' );


	function link( $title, $href = null, $options = array(), $confirm = null, $escapeTitle = true )
	{
		if( !isset( $href ) )
		{
			$href = $title;
		}

		if( !isset( $options['url'] ) )
		{
			$options['url'] = $href;
		}

		if( isset( $confirm ) )
		{
			$options['confirm'] = $confirm;
			unset( $confirm );
		}

		$htmlOptions = $this->__getHtmlOptions( $options );

		if( empty( $options['fallback'] ) || !isset( $options['fallback'] ) )
		{
			$options['fallback'] = $href;
		}

		if( !isset( $htmlOptions['id'] ) )
		{
			$htmlOptions['id'] = 'link' . intval( rand() );
		}

		if( !isset( $htmlOptions['onclick'] ) )
		{
			$htmlOptions['onclick'] = '';
		}

		$htmlOptions['onclick'] .= ' return false;';
		$return = "<a href=\"$href\"";
		foreach( $htmlOptions as $key => $val )
		{
			$return .= " $key=\"$val\"";
		}
		$return .= '>';
		$return .= $escapeTitle ? htmlspecialchars( $title ) : $title;
		$return .= '</a>';

		$script = $this->event( "'{$htmlOptions['id']}'", "click", $this->remoteFunction( $options ) );

		if( is_string( $script ) )
		{
			$return .= $script;
		}

		return $return;
	}
	
	
	function remoteFunction($options = null) {

		if (isset($options['update'])) {
			if (!is_array($options['update'])) {
				$func = "new Ajax.Updater('{$options['update']}',";
			} else {
				$func = "new Ajax.Updater(document.createElement('div'),";
			}
			if (!isset($options['requestHeaders'])) {
				$options['requestHeaders'] = array();
			}
			if (is_array($options['update'])) {
				$options['update'] = join(' ', $options['update']);
			}
			$options['requestHeaders']['X-Update'] = $options['update'];
		} else {
			$func = "new Ajax.Request(";
		}

		$func .= "'" . (isset($options['url']) ? $options['url'] : "") . "'";
		$func .= ", " . $this->__optionsForAjax($options) . ")";

		if (isset($options['before'])) {
			$func = "{$options['before']}; $func";
		}

		if (isset($options['after'])) {
			$func = "$func; {$options['after']};";
		}

		if (isset($options['condition'])) {
			$func = "if ({$options['condition']}) { $func; }";
		}

		if (isset($options['confirm'])) {
			$func = "if (confirm('" . $this->escapeString($options['confirm'])
				. "')) { $func; } else { return false; }";
		}
		return $func;
	}
	
	
	function __getHtmlOptions( $options, $extra = array() )
	{
		foreach( $this->ajaxOptions as $key )
		{
			if( isset( $options[$key] ) )
			{
				unset( $options[$key] );
			}
		}

		foreach( $extra as $key )
		{
			if( isset($options[$key] ) )
			{
				unset( $options[$key] );
			}
		}

		return $options;
	}


	function __optionsForAjax($options = array()) {

		if (isset($options['indicator'])) {
			if (isset($options['loading'])) {
				if (!empty($options['loading']) && substr(trim($options['loading']), -1, 1) != ';') {
					$options['loading'] .= '; ';
				}
				$options['loading']  .= "Element.show('{$options['indicator']}');";
			} else {
				$options['loading']   = "Element.show('{$options['indicator']}');";
			}
			if (isset($options['complete'])) {
				if (!empty($options['complete']) && substr(trim($options['complete']), -1, 1) != ';') {
					$options['complete'] .= '; ';
				}
				$options['complete'] .= "Element.hide('{$options['indicator']}');";
			} else {
				$options['complete']  = "Element.hide('{$options['indicator']}');";
			}
			unset($options['indicator']);
		}

		$jsOptions = array_merge(
			array('asynchronous' => 'true', 'evalScripts'  => 'true'),
			$this->_buildCallbacks($options)
		);
		$options = $this->_optionsToString($options, array('method'));

		foreach($options as $key => $value) {
			switch($key) {
				case 'type':
					$jsOptions['asynchronous'] = ( ($value == 'synchronous') ? 'true' : 'false' );
				break;
				case 'evalScripts':
					$jsOptions['evalScripts'] = ( $value ? 'false' : 'true' );
				break;
//				case 'position':
//					$jsOptions['insertion'] = "Insertion." . Inflector::camelize($options['position']);
//				break;
				case 'with':
					$jsOptions['parameters'] = $options['with'];
				break;
				case 'form':
					$jsOptions['parameters'] = 'Form.serialize(this)';
				break;
				case 'requestHeaders':
					$keys = array();
					foreach ($value as $key => $val) {
						$keys[] = "'" . $key . "'";
						$keys[] = "'" . $val . "'";
					}
					$jsOptions['requestHeaders'] = '[' . join(', ', $keys) . ']';
				break;
			}
		}
		return $this->_buildOptions($jsOptions, $this->ajaxOptions);
	}


	function _buildOptions($options, $acceptable) {
		if (is_array($options)) {
			$out = array();

			foreach($options as $k => $v) {
				if (in_array($k, $acceptable)) {
					$out[] = "$k:$v";
				}
			}

			$out = join(', ', $out);
			$out = '{' . $out . '}';
			return $out;
		} else {
			return false;
		}
	}


	function _buildCallbacks($options) {
		$callbacks = array();

		foreach($this->callbacks as $callback) {
			if (isset($options[$callback])) {
				$name = 'on' . ucfirst($callback);
				$code = $options[$callback];
				if ($name == 'onComplete') {
					$callbacks[$name] = "function(request, json){" . $code . "}";
				} else {
					$callbacks[$name] = "function(request){" . $code . "}";
				}
				if (isset($options['bind'])) {
					if ((is_array($options['bind']) && in_array($callback, $options['bind'])) || (is_string($options['bind']) && strpos($options['bind'], $callback) !== false)) {
						$callbacks[$name] .= ".bind(this)";
					}
				}
			}
		}
		return $callbacks;
	}


	function _optionsToString($options, $stringOpts = array()) {
		foreach($stringOpts as $option) {
			if (isset($options[$option]) && !$options[$option][0] != "'") {
				if ($options[$option] === true || $options[$option] === 'true') {
					$options[$option] = 'true';
				} elseif ($options[$option] === false || $options[$option] === 'false') {
					$options[$option] = 'false';
				} else {
					$options[$option] = "'{$options[$option]}'";
				}
			}
		}
		return $options;
	}
}