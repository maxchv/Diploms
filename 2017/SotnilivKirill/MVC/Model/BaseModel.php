<?php namespace MVC\Model;

use MVC\Views\ViewModel;

 class BaseModel{
		protected $viewModel;

		public function __construct(){
			$this->viewModel = new viewModel();
			$this->commonViewData();			
		}

		protected function commonViewData(){
			// инициализация общих данных		
		}
	}
?>