<?php

$container['router'] = function() use ($defaultModule, $modules) {

	$router = new \Phalcon\Mvc\Router();
	$router->clear();

	/**
	 * Default Routing
	 */
	$router->add('/', [
	    'namespace'     => $modules[$defaultModule]['controllerNamespace'],
		'module'        => $defaultModule,
	    'controller'    => isset($modules[$defaultModule]['defaultController']) ? $modules[$defaultModule]['defaultController'] : 'index',
	    'action'        => isset($modules[$defaultModule]['defaultAction']) ? $modules[$defaultModule]['defaultAction'] : 'index'
	]);

	/**
	 * Not Found Routing
	 */
	$router->notFound(
		[
			'namespace' => 'Gelarapps\Common\Web\Controller',
			'controller' => 'error',
			'action'     => 'notfound',
		]
	);

	/**
	 * Error Routing
	 */
	$router->addGet('/forbidden', [
		'namespace' => "Gelarapps\Common\Web\Controller",
		'controller' => "error",
		'action' => "route403"
	]);
	
	$router->addGet('/error', [
		'namespace' => "Gelarapps\Common\Web\Controller",
		'controller' => "error",
		'action' => "routeErrorCommon"
	]);
	
	$router->addGet('/expired', [
		'namespace' => "Gelarapps\Common\Web\Controller",
		'controller' => "error",
		'action' => "routeErrorState"
	]);

	$router->addGet('/maintenance', [
		'namespace' => "Gelarapps\Common\Web\Controller",
		'controller' => "error",
		'action' => "maintenance"
	]);

	foreach ($modules as $moduleName => $module) {

		if ($module['defaultRouting'] == true) {
			/**
			 * Default Module routing
			 */
			$router->add('/'. $moduleName . '/:params', array(
				'namespace' => $module['controllerNamespace'],
				'module' => $moduleName,
				'controller' => isset($module['defaultController']) ? $module['defaultController'] : 'index',
				'action' => isset($module['defaultAction']) ? $module['defaultAction'] : 'index',
				'params'=> 1
			));
			
			$router->add('/'. $moduleName . '/:controller/:params', array(
				'namespace' => $module['controllerNamespace'],
				'module' => $moduleName,
				'controller' => 1,
				'action' => isset($module['defaultAction']) ? $module['defaultAction'] : 'index',
				'params' => 2
			));

			$router->add('/'. $moduleName . '/:controller/:action/:params', array(
				'namespace' => $module['controllerNamespace'],
				'module' => $moduleName,
				'controller' => 1,
				'action' => 2,
				'params' => 3
			));	

			

		} else {
			
			$webModuleRouting = APP_PATH . '/modules/'. $moduleName .'/config/routes/web.php';
			
			if (file_exists($webModuleRouting) && is_file($webModuleRouting)) {
				include $webModuleRouting;
			}
		}
	}
	
	
	$router->removeExtraSlashes(true);
	
    
	return $router;
};