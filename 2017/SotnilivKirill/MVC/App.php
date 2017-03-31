<?php namespace MVC;

use MVC\Controllers\BaseController;
use MVC\Config\RouterConfig;
use MVC\Config\ControllerConfig;

	class App{
		private $controllerName;
		private $controllerClass;
		private $action;
		private $id;

		//разбор URL, получение контроллера, действия, id
		public function __construct(){
			$controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING);
			$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
			$this->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

			if (empty($controller)) {
				$this->controllerName = RouterConfig::MAP['defaults']['controller'];
			}
			else{
				$this->controllerName = $controller;
			}
			$this->controllerClass = ControllerConfig::makeClassName($this->controllerName);

			if (empty($action)) {
				$this->action = RouterConfig::MAP['defaults']['action'];
			}
			else{
				$this->action = $action;
			}
		}

		public function createController(){
			//1. проверить наличие файла с классом

			//2. проверить наличие класса $this->controllerClass в файле

			//3. является ли этот класс производным от BaseController

			//4. проверить наличие в этом классе мтода $this->action

			//5. вернуть экземпляр класса $this->controllerClass
			return new $this->controllerClass(['action'=>$this->action, 'id'=>$this->id]);
		}
	}
?>