<?php namespace Controllers;

use MVC\Controllers\BaseController;
use Models\HomeModel;

class HomeController extends BaseController{

 		public function __construct(array $init){
 				parent::__construct($init);
 				$this->model = new HomeModel();		
 		}

		public function index($id = null){
			$this->view->output($this->model->index($id));
		}

		public function about($id = null){
			$this->view->output($this->model->about($id));
		}

		public function contact($id = null){
			$this->view->output($this->model->contact($id));
		}

		public function register($id = null){
			$this->view->output($this->model->register($id));	
		}
		
		public function login($id = null){
			$this->view->output($this->model->login($id));
		}
		
		public function checkRegister($id = null){
			$this->view->output($this->model->checkRegister($id));
		}
		
		public function checkLogin($id = null){
			$this->view->output($this->model->checkLogin($id));
		}
		
		public function article($id = null){
			$this->view->output($this->model->article($id));
		}
		
		public function selectedcategory($id = null){
			$this->view->output($this->model->selectedcategory($id));
		}
		
		public function search($id = null){
			$this->view->output($this->model->search($id));
		}
	}
?>