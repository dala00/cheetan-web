<?php
define('CONFIGS', LIB_DIR . 'config' . DIRECTORY_SEPARATOR);
define('MODELS', LIB_DIR . 'models' . DIRECTORY_SEPARATOR);
define('CONTROLLERS', LIB_DIR . 'controllers' . DIRECTORY_SEPARATOR);
define('VIEWS', LIB_DIR . 'views' . DIRECTORY_SEPARATOR);
define('COMPONENTS', LIB_DIR . 'components' . DIRECTORY_SEPARATOR);

require_once LIB_DIR . 'cheetan' . DIRECTORY_SEPARATOR . 'cheetan.php';

function config_controller_class() {
	$params = getUrlParameter();
	$controllerPath = CONTROLLERS . $params['controller'] . '_controller.php';
	if (!file_exists($controllerPath)) {
		echo 'Create ' . $params['controller'] . '_controller.php';
		exit;
	}
	$controllerClass = 'C' .  ucfirst($params['controller']) . 'Controller';
	require_once LIB_DIR . 'app_controller.php';
	require_once $controllerPath;
	if (!class_exists($controllerClass)) {
		echo "Create class '$controllerClass'";
		exit;
	}
	return $controllerClass;
}

function getUrlParameter() {
	$url = '/' . $_GET['url'];
	include CONFIGS . 'routes.php';
	foreach ($routes as $pattern => $route) {
		$pattern = str_replace('/', '\/', $pattern);
		$pattern = str_replace('*', '[^\/]+', $pattern);
		if (preg_match("/^$pattern" . '$/', $url)) {
			$params = $route;
			break;
		}
	}
	if (empty($params)) {
		$tmp = explode('/', $_GET['url']);
		$params['controller'] = $tmp[0];
		$params['action'] = empty($tmp[1]) ? 'index' : $tmp[1];
		$count = count($tmp);
		foreach ($tmp as $i => $value) {
			if ($i >= 2) {
				$params[] = $value;
			}
		}
	}
	return $params;
}

function config_database(&$db) {
	require_once CONFIGS . 'database.php';
	foreach ($databases as $name => $database) {
		$driver = $database['connect'] ? $database['connect'] : DBKIND_MYSQL;
		$port = empty($database['port']) ? 0 : $database['port'];
		$db->add($name, $database['host'], $database['login'], $database['password'], $database['database'], $driver, $port);
		if (!empty($database['encoding'])) {
			$db->query("SET NAMES " . $database['encoding']);
		}
	}
}

function config_models(&$controller) {
	$params = getUrlParameter();
	if ($controller->uses === null) {
		$models = array($params['controller']);
	} else {
		$models = $controller->uses;
	}
	if ($models) {
		if (!is_array($models)) {
			$models = array($models);
		}
		foreach ($models as $model) {
			 $controller->AddModel(MODELS . strtolower($model) . '.php');
		}
	}
}

function config_components(&$controller) {
	if (!$controller->components) {
		return;
	}
	foreach ($controller->components as $component) {
		$controller->AddComponent(COMPONENTS . strtolower($component) . '.php');
	}
}

function is_secure(&$controller) {
	return $controller->is_secure();
}

function check_secure(&$controller) {
	$controller->check_secure();
}

function config_controller(&$controller) {
	$params = getUrlParameter();
	$controller->params = &$params;
	$controller->config_controller();
}

function action(&$controller) {
	$params = $controller->params;
	$action = $params['action'];
	$controller->SetTemplateFile(VIEWS . 'layouts' . DIRECTORY_SEPARATOR . 'default.html');
	$controller->SetViewFile(VIEWS . $params['controller'] . DIRECTORY_SEPARATOR . "$action.html");
	unset($params['controller']);
	unset($params['action']);
	if (method_exists($controller, $action)) {
		call_user_func_array(array(&$controller, $action), $params);
	}
}

function after_action(&$controller) {
	$controller->after_action();
}

function after_render(&$controller) {
	$controller->after_render();
}
