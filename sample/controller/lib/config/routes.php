<?php
$routes = array(
	'/' => array('controller' => 'blog_data', 'action' => 'index'),
	'/page/*' => array('controller' => 'page', 'action' => 'view'),
);