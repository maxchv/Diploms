<?php namespace MVC\Views;

// передавать данные для представления из модели
class ViewModel{	
		// получить	данные
		public function get($name){
			if (isset($this->{$name})) {
						return $this->{$name};
				}
			else {
						return null;
				 }		
		}
		// задать данные необходимые для представления
		public function set($name, $value){
			$this->{$name} = $value;
		}

	}
?>