<?php namespace MVC\Controllers;

use MVC\Views\View;

	class BaseController{
		protected $model;
		protected $id;
		protected $action;
		protected $view;
		protected $template;

		public function __construct(array $init){
			
			$this->action = $init['action'];
			if (!empty($init['id'])) {
				$this->id = $init['id'];
			}

			$this->view = new View(get_class($this), $this->action, $this->template);
		}

		public function executeAction(){
			// выполнение действия указаного в строке $this->action
			// по умолчанию - это index()
			return $this->{$this->action}($this->id);
		}

	}
?>