<?php namespace Models;

spl_autoload_extensions('php');
spl_autoload_register();

use MVC\Model\BaseModel;
use MVC\Views\ViewModel;
use MVC;

class HomeModel extends BaseModel{
		public function index($id = null){
			$this->viewModel->set('pageTitle', 'Главная');
			$db = MVC\Config\DbConfig::getConnection();
            //echo "db: $db<br/>";
            //var_dump($db);
			$page = $id;
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			// Устанавливаем количество записей, которые будут выводиться на одной странице
			// Количество записей на страницу
			$quantity=2;
			
			// Ограничиваем количество ссылок, которые будут выводиться перед и
			// после текущей страницы
			$limit=3;
			$this->viewModel->set('limit',$limit);
			
			// Если значение page= не является числом или оно меньше единицы, то показываем
			// пользователю первую страницу
			if(!is_numeric($page)||$page<1){
				$page=1;
			}			
			
			// Узнаем количество всех доступных записей
			$result2 = mysqli_query($db,"SELECT * FROM articles;");
			$num = mysqli_num_rows($result2);
			
			// Вычисляем количество страниц, чтобы знать сколько ссылок выводить
			$pages = $num/$quantity;
			
			// Округляем полученное число страниц в большую сторону
			$pages = ceil($pages);
			
			// Если значение page= больше числа страниц, то выводим первую страницу
			if ($page>$pages){
				$page = 1;
			}
								
			// Здесь мы увеличиваем число страниц на единицу чтобы начальное значение было
			// равно единице, а не нулю. Значение page= будет
			// совпадать с цифрой в ссылке, которую будут видеть посетители
			$pages++;
		
			// Переменная $list указывает с какой записи начинать выводить данные.
			// Если это число не определено, то будем выводить
			// с самого начала, то-есть с нулевой записи
			if (!isset($list)) $list=0;
			
			// Чтобы у нас значение page= в адресе ссылки совпадало с номером
			// страницы мы будем его увеличивать на единицу при выводе ссылок, а
			// здесь наоборот уменьшаем чтобы ничего не нарушить.
			$list=--$page*$quantity;
			
			// Делаем запрос подставляя значения переменных $quantity и $list
			$result = mysqli_query($db,"SELECT * FROM articles ORDER BY Id DESC LIMIT $quantity OFFSET $list;");
			// Считаем количество полученных записей
			$num_result = mysqli_num_rows($result);
			
			$allResults = array();
			// Выводим все записи текущей страницы
			for ($i = 0; $i<$num_result; $i++) {
				$allResults[] = mysqli_fetch_array($result);
			}
			
			$this->viewModel->set('page', $page);
			$this->viewModel->set('pages', $pages);
			$this->viewModel->set('allResults',$allResults);	
			return $this->viewModel;
		}

		public function about($id = null){
			$this->viewModel->set('pageTitle', 'FAQ');
			$this->viewModel->set('message', 'Your application description page.');
			return $this->viewModel;	
		}

		public function contact($id = null){
			$this->viewModel->set('pageTitle', 'Контакты');
			
			if (isset ( $_REQUEST ['message'] ) && isset ( $_REQUEST ['subject'] )) {
					$mail = "sotnikov1@mail.ru";
					$headers = [ 
							'MIME-Version: 1.0',
							'Content-type: text/html; charset=utf-8',
							"From: Blog <$mail>" 
					];
					$from = htmlspecialchars ( $_REQUEST ['email'] );
					$subj = htmlspecialchars ( $_REQUEST ['subject'] );
					$mess = htmlspecialchars ( $_REQUEST ['message'] );
					$message = "От: $from<br />Тема:  $subj<br />Сообщение:<br />$mess<br />";
					mail( $mail, "Сообщение от Blog. Тема: " . $_REQUEST ['subject'], $message, join ( "\r\n", $headers ) );
					$state = "<font size=\"4\" color=\"green\">Сообщение отправлено!</font>";
					$this->viewModel->set('state', $state);
			}			
			return $this->viewModel;
		}

		public function register($id = null){
			$this->viewModel->set('pageTitle', 'Регистрация');
			return $this->viewModel;
		}

		public function login($id = null){
			$this->viewModel->set('pageTitle', 'Вход');
			return $this->viewModel;
		}
		public function checkRegister($id = null){
			$this->viewModel->set('pageTitle', 'Проверка регистрации');
			return $this->viewModel;
		}
		public function checkLogin($id = null){
			$this->viewModel->set('pageTitle', 'Проврка логина');
			return $this->viewModel;
		}
		public function article($id = null){
			$this->viewModel->set('pageTitle', 'Статья');
			$db = MVC\Config\DbConfig::getConnection();
			session_start();		
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			$selectedArticle = mysqli_query($db,"SELECT * FROM articles WHERE Id='$id';");
			$articleRow = mysqli_fetch_array($selectedArticle);
			
			// Делаем запрос
			$result = mysqli_query($db,"SELECT * FROM comments WHERE ArticleId='$id'");
			// Считаем количество полученных записей
			$num_result = mysqli_num_rows($result);
				
			$allCommentsResults = array();
			// Выводим все записи текущей страницы
			for ($i = 0; $i<$num_result; $i++) {
				$allCommentsResults[] = mysqli_fetch_array($result);
			}
			$categoryId = $articleRow['CategoryId'];
			$result = mysqli_query($db,"SELECT * FROM categories WHERE Id='$categoryId'");
			$categoryrow = mysqli_fetch_array($result);
			
			$userId = $articleRow['Userid'];
			$result2 = mysqli_query($db,"SELECT * FROM users WHERE id='$userId'");
			$userrow = mysqli_fetch_array($result2);
			
			$this->viewModel->set('commenterror',$commenterror);
			$this->viewModel->set('articleRow',$articleRow);
			$this->viewModel->set('allCommentsResults',$allCommentsResults);
			$this->viewModel->set('categoryrow', $categoryrow);
			$this->viewModel->set('userrow', $userrow);
			return $this->viewModel;
		}
		public function selectedcategory($id = null){
			$this->viewModel->set('pageTitle', 'Выбранная категория');
			$db = MVC\Config\DbConfig::getConnection();
			$page = $id;
			session_start();
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			if(isset($_POST['categoryName'])||isset($_SESSION['selectedCategory'])){
				if (isset($_POST['categoryName']))
				{
					$categoryName = $_POST['categoryName'];
					$_SESSION['selectedCategory'] = $categoryName;
				}
				else{
					$categoryName = $_SESSION['selectedCategory'];
				} 
				$categoryRow = mysqli_query($db,"SELECT * FROM categories WHERE Name='$categoryName';");
				$row = mysqli_fetch_array($categoryRow);
				$categoryId = $row['Id'];
				
					
				
					
				// Устанавливаем количество записей, которые будут выводиться на одной странице
				// Количество записей на страницу
				$quantity=2;
					
				// Ограничиваем количество ссылок, которые будут выводиться перед и
				// после текущей страницы
				$limit=3;
				$this->viewModel->set('limit',$limit);
					
				// Если значение page= не является числом или оно меньше единицы, то показываем
				// пользователю первую страницу
				if(!is_numeric($page)||$page<1){
					$page=1;
				}
					
				// Узнаем количество всех доступных записей
				$result2 = mysqli_query($db,"SELECT * FROM articles WHERE CategoryId='$categoryId' ORDER BY Id DESC;");
				$num = mysqli_num_rows($result2);
					
				// Вычисляем количество страниц, чтобы знать сколько ссылок выводить
				$pages = $num/$quantity;
					
				// Округляем полученное число страниц в большую сторону
				$pages = ceil($pages);
					
				// Если значение page= больше числа страниц, то выводим первую страницу
				if ($page>$pages){
					$page = 1;
				}
				
				// Здесь мы увеличиваем число страниц на единицу чтобы начальное значение было
				// равно единице, а не нулю. Значение page= будет
				// совпадать с цифрой в ссылке, которую будут видеть посетители
				$pages++;
				
				// Переменная $list указывает с какой записи начинать выводить данные.
				// Если это число не определено, то будем выводить
				// с самого начала, то-есть с нулевой записи
				if (!isset($list)) $list=0;
					
				// Чтобы у нас значение page= в адресе ссылки совпадало с номером
				// страницы мы будем его увеличивать на единицу при выводе ссылок, а
				// здесь наоборот уменьшаем чтобы ничего не нарушить.
				$list=--$page*$quantity;
					
				// Делаем запрос подставляя значения переменных $quantity и $list
				$result = mysqli_query($db,"SELECT * FROM articles WHERE CategoryId='$categoryId' ORDER BY Id DESC LIMIT $quantity OFFSET $list;");
				// Считаем количество полученных записей
				$num_result = mysqli_num_rows($result);
					
				$allResults = array();
				// Выводим все записи текущей страницы
				for ($i = 0; $i<$num_result; $i++) {
					$allResults[] = mysqli_fetch_array($result);
				}
					
				$this->viewModel->set('page', $page);
				$this->viewModel->set('pages', $pages);
				$this->viewModel->set('allResults',$allResults);
				return $this->viewModel;
			}
			 else{
				header('Location: /Home/');
			}  
			 return $this->viewModel;
		}
		public function search($id = null){
			$this->viewModel->set('pageTitle', 'Поиск');
			$db = MVC\Config\DbConfig::getConnection();
			$page = $id;
			session_start();
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			if(isset($_POST['search'])||isset($_SESSION['selectedSearch'])){
				if (isset($_POST['search']))
				{
					$searchWord = $_POST['search'];
					$_SESSION['selectedSearch'] = $searchWord;
				}
				else{
					$searchWord = $_SESSION['selectedSearch'];
				} 
					
				// Устанавливаем количество записей, которые будут выводиться на одной странице
				// Количество записей на страницу
				$quantity=2;
					
				// Ограничиваем количество ссылок, которые будут выводиться перед и
				// после текущей страницы
				$limit=3;
				$this->viewModel->set('limit',$limit);
					
				// Если значение page= не является числом или оно меньше единицы, то показываем
				// пользователю первую страницу
				if(!is_numeric($page)||$page<1){
					$page=1;
				}
					
				// Узнаем количество всех доступных записей
				$result2 = mysqli_query($db,"SELECT * FROM articles WHERE Header LIKE '%$searchWord%' ORDER BY Id DESC;");
				$num = mysqli_num_rows($result2);
				$this->viewModel->set('num', $num);
				// Вычисляем количество страниц, чтобы знать сколько ссылок выводить
				$pages = $num/$quantity;
						
				// Округляем полученное число страниц в большую сторону
				$pages = ceil($pages);
						
					// Если значение page= больше числа страниц, то выводим первую страницу
					if ($page>$pages){
						$page = 1;
					}
					
					// Здесь мы увеличиваем число страниц на единицу чтобы начальное значение было
					// равно единице, а не нулю. Значение page= будет
					// совпадать с цифрой в ссылке, которую будут видеть посетители
					$pages++;
					
					// Переменная $list указывает с какой записи начинать выводить данные.
					// Если это число не определено, то будем выводить
					// с самого начала, то-есть с нулевой записи
					if (!isset($list)) $list=0;
						
					// Чтобы у нас значение page= в адресе ссылки совпадало с номером
					// страницы мы будем его увеличивать на единицу при выводе ссылок, а
					// здесь наоборот уменьшаем чтобы ничего не нарушить.
					$list=--$page*$quantity;
						
					// Делаем запрос подставляя значения переменных $quantity и $list
					$result = mysqli_query($db,"SELECT * FROM articles WHERE Header LIKE '%$searchWord%' ORDER BY Id DESC LIMIT $quantity OFFSET $list;");
					// Считаем количество полученных записей
					$num_result = mysqli_num_rows($result);
						
					$allResults = array();
					// Выводим все записи текущей страницы
					for ($i = 0; $i<$num_result; $i++) {
						$allResults[] = mysqli_fetch_array($result);
					}
						
					$this->viewModel->set('page', $page);
					$this->viewModel->set('pages', $pages);
					$this->viewModel->set('allResults',$allResults);
					return $this->viewModel;
			}
			 else{
			 	header('Location: /Home/');
			}  
			 return $this->viewModel;  
		}
	}
?>