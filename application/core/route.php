<?php
class Route
{
	static function start()
	{
		session_start();
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		$parameter_name = "";
		$routesWithParams = explode('?', $_SERVER['REQUEST_URI']);
		$routes = explode('/', $routesWithParams[0]);
		//$routes = explode('/', $_SERVER['REQUEST_URI']);
		$getParams = Route::ProcessParameters($routesWithParams[1]);
		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}
		//получаем параметр
		if(!empty($routes[3])){
			$parameter_name = $routes[3];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'Action_'.$action_name;

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			// ес оишбка, то на 404 страницу
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			if($parameter_name != ""){
				$controller->$action($parameter_name);
			}else if(isset($getParams)){
				
				$controller->$action($getParams);
			}
			else{
				$controller->$action();
			}
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}
	
	static function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.0 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');

    }

	static function RedirectToMain(){
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('Location:'.$host.'main');
	}

	static function RedirectToLogin(){
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('Location:'.$host.'login');
	}

	private static function ProcessParameters($params){
		if(!isset($params)){
			return null;
		}

		$arrayParams = array();
		$keysValues = explode('&', $params);
		foreach($keysValues as $param){
			$keyValue = explode('=', $param);
			$arrayParams += [$keyValue[0] => $keyValue[1]];
		}
		return $arrayParams;
	}
}
?>