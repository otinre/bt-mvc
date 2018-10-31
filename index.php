<?php
// Core components paths
define('CORE_DIR', 'core' . DIRECTORY_SEPARATOR);
define('CORE_LIB_DIR', CORE_DIR . 'lib' . DIRECTORY_SEPARATOR);
define('CORE_COMPONENTS_DIR', CORE_LIB_DIR . 'components' . DIRECTORY_SEPARATOR);
// User code paths
define('SRC_DIR', 'src' . DIRECTORY_SEPARATOR);
define('MODEL_DIR', SRC_DIR . 'models' . DIRECTORY_SEPARATOR);
define('CONTROLLER_DIR', SRC_DIR . 'controllers' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', SRC_DIR . 'views' . DIRECTORY_SEPARATOR);
define('TEMPLATE_DIR', VIEW_DIR . 'templates'. DIRECTORY_SEPARATOR);
// Main layout template file name base
define('BASE_TEMPLATE', 'base');
$indexName = basename(__FILE__);
$baseDir = strtr(__DIR__, '/\\', DIRECTORY_SEPARATOR);
$baseUrl = substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], $indexName));
$pathInfo = substr($_SERVER['REQUEST_URI'], strlen($baseUrl));
require_once CORE_COMPONENTS_DIR . 'Response.php';
if (!$pathInfo) {
$pathInfo = '/';
}
if (!isset($_SERVER['HTTP_REWRITE_ON'])) {
$baseUrl = $baseUrl . $indexName . $pathInfo;
}
$controllerPrefix = 'Default';
$actionPrefix = 'default';
$route = array_filter(explode('/', $pathInfo));
$controller = CONTROLLER_DIR . $controllerPrefix . 'Controller.php';
$action = $actionPrefix . 'Action';
$model = '';
if (!empty($route)) {
if ($route[0] == $indexName) {
unset($route[0]);
$route = array_values($route);
}
if ((isset($route[0])) && ($route[0])) {
$controller = str_replace($controllerPrefix, ucfirst(strtolower($route[0])), $controller);
}
if ((isset($route[1])) && ($route[1])) {
$action = str_replace($actionPrefix, strtolower($route[1]), $action);
}
if ((isset($route[2])) && ($route[2])) {
$model = $route[2];
}
}
if (file_exists($controller)) {
include_once $controller;
if (function_exists($action)) {
$result = $action($model);
echo $result;
exit();
} else {
http_response_code('404');
exit();
}
} else {
http_response_code('400');
exit();
}
   ?>
