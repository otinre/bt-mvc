<?php
$indexName = basename(__FILE__);
$baseDir = strtr(__DIR__, '/\\', DIRECTORY_SEPARATOR);
$baseUrl = substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'],
$indexName));
$pathInfo = substr($_SERVER['REQUEST_URI'], strlen($baseUrl));
if (!isset($_SERVER['HTTP_REWRITE_ON'])) {
    $baseUrl = $baseUrl . $indexName;
   }   
   $controller = $controllerPrefix . 'Controller.php';
   $action = $actionPrefix . 'Action';
   $model = '';
   var_dump($controller, $action, $model);
   


?>
