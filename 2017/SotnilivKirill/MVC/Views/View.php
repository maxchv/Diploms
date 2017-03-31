<?php namespace MVC\Views;

use MVC\Config\ViewConfig;

class View{
		protected $viewFile;
		protected $controllerClass;
		protected $template;
		
		public function __construct($controllerClass, $action, $template){
			$this->viewFile = ViewConfig::getFile($controllerClass, $action);
			$this->controllerClass = $controllerClass;
			$this->template = $template;
		}

		public function output(ViewModel $viewModel){
                        
            
			$template = ViewConfig::getTemplate($this->template,$this->controllerClass);
            //echo "template: " . $template;

			if (file_exists($template)) {
				//echo "exists";
                require $template;
                
			}
			elseif (file_exists($this->viewFile)) {
				require $this->viewFile;
			}
			else{
				// обработка ошибки отсутствия файла представления
                echo "error";
			}
		}

		
	}
?>