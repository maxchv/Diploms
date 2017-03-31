<?php namespace MVC\Config;

	class ControllerConfig{
		 const DIR = 'Controllers';
		 const SUFFIX = 'Controller';
		 const ERROR = 'Error';
		 const EXT = '.php';

		// default input:
		// 		$controllerClass->Controllers\HomeController
		// return
		// 		Home
		public static function getName($controllerClass){
			if (preg_match('/'.self::DIR.'\\\\(\w+)'.self::SUFFIX.'/', $controllerClass, $m)) {
				return strtolower($m[1]); //Home
			}
			else{
				return '';
			}
		}

		public static function makeClassName($name){
			return self::DIR.'\\'. ucfirst(strtolower($name)).self::SUFFIX;
		}
			
		public static function getFile(){

		}
	}
?>