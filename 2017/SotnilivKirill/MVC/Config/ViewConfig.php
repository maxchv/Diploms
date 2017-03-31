<?php namespace MVC\Config;

use MVC\Config\ControllerConfig;
use MVC\Helpers\Path;

class ViewConfig{
		 const DIR ='Views';
		 const EXT = '.php';
// 		 const TEMPLATE = 'Layouts/main'.self::EXT;
		 const ERROR = 'Error';
		

		 // default input:
			// 		$controllerClass->Controllers\HomeController
			// 		$action -> index
			// return
			// 		Views/Home/index.php
		public static function getFile($controllerClass, $action){
			
			$controllerName = ControllerConfig::getName($controllerClass);
			return self::DIR."/".ucfirst($controllerName)."/".$action.self::EXT;
		}

		// Возвращает путь к файлу шаблону
		public static function getTemplate(string $template = null, $controllerClass){
			
			if (file_exists($template)) {
				$file = $template;
			}
			else{
// 				$file = self::DIR."/".self::TEMPLATE;
				$file = self::DIR."/"."Layouts/".ControllerConfig::getName($controllerClass).self::EXT;
			}
            
            
            $file = Path::getAbsolutePath() . $file;
            //echo "file: "  . $file;
            
			return $file;
		}
	}
?>