<?php namespace Controllers;

use MVC\Controllers\BaseController;
use Models\UserModel;

class UserController extends BaseController{

 		public function __construct(array $init){
 				parent::__construct($init);
 				$this->model = new UserModel();
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
		
		public function profile($id = null){
			$this->view->output($this->model->profile($id));
		}
		
		public function changepassword($id = null){
			$this->view->output($this->model->changepassword($id));
		}
		
		public function createarticle($id = null){
			$this->view->output($this->model->createarticle($id));
		}
		
		public function checkarticle($id = null){
			$this->view->output($this->model->checkarticle($id));
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
		
		public function deletearticle($id = null){
			$this->view->output($this->model->deletearticle($id));
		}
		
		public function changearticle($id = null){
			$this->view->output($this->model->changearticle($id));
		}
		
		public function deletecomment($id = null){
			$this->view->output($this->model->deletecomment($id));
		}
		
		public function logout($id = null){
			$this->view->output($this->model->logout($id));
		}
		
	}
?>