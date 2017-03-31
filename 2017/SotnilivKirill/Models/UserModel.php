<?php namespace Models;
spl_autoload_extensions('php');
spl_autoload_register();

use MVC\Model\BaseModel;
use MVC\Views\ViewModel;
use MVC;

class UserModel extends BaseModel{
		public function index($id = null){
			$this->viewModel->set('pageTitle', 'Главная');
			$db = MVC\Config\DbConfig::getConnection();
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
		
		public function profile($id = null){
			$this->viewModel->set('pageTitle', 'Профиль');
			session_start();
			
			$id = $_SESSION['Id'];
			$login = $_SESSION['Login'];
			$role = $_SESSION['Role'];
			$date = $_SESSION['Date'];
			$avatar = $_SESSION['Avatar'];
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			$this->viewModel->set('id', $id);
			$this->viewModel->set('login', $login);
			$this->viewModel->set('role', $role);
			$this->viewModel->set('date', $date);
			$this->viewModel->set('avatar', $avatar);
			return $this->viewModel;
		}
		
		public function changepassword($id = null){
			$this->viewModel->set('pageTitle', 'Смена пароля');
			$db = MVC\Config\DbConfig::getConnection();
			session_start();
			$id = $_SESSION['Id'];
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			$result = mysqli_query($db,"SELECT * FROM users WHERE id='$id'"); //извлекаем из базы все данные о пользователе с активным id
			$myrow = mysqli_fetch_array($result);
			
			if (!empty($_POST['oldpassword'])&&!empty($_POST['newpassword'])&&!empty($_POST['confirmnewpassword'])){
				$oldpass = $_POST['oldpassword'];
				$newpass = $_POST['newpassword'];
				$confirmnewpass = $_POST['confirmnewpassword'];
			
				if($newpass!=$confirmnewpass){
					$state = "<font size=\"4\" color=\"red\">Пароли не совпадают!</font>";
				}
				elseif(!password_verify($oldpass, $myrow['Password']))
				{
					$state = "<font size=\"4\" color=\"red\">Указан неверный пароль!</font>";
				}
				elseif(strlen($newpass)>12 || strlen($newpass)<6)
				{
					$state = "<font size=\"4\" color=\"red\">Длина нового пароля должна быть от 6 до 12 символов</font>";
				}
				else{
					//если оба пароля введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
					$oldpass = stripslashes($oldpass);
					$oldpass = htmlspecialchars($oldpass);
					$newpass = stripslashes($newpass);
					$newpass = htmlspecialchars($newpass);
			
					//удаляем лишние пробелы
					$oldpass = trim($oldpass);
					$newpass = trim($newpass);
					//хешируем пароль
					$newpass = password_hash($newpass, PASSWORD_BCRYPT);
			
					//обновляем данные
					$result2 = mysqli_query($db,"UPDATE users SET Password = '$newpass' WHERE id = '$id'");
			
					// Проверяем, есть ли ошибки
					if ($result2=='TRUE')
					{
						$state = "<font size=\"4\" color=\"green\">Вы успешно поменяли пароль!</font>";
					}
					else {
						$state = "<font size=\"4\" color=\"red\">Ошибка!</font>";
					}
				}
			}
			else{
				$state = "<font size=\"4\" color=\"red\">Заполните все поля!</font>";
			}
			
			$this->viewModel->set('state', $state);
			return $this->viewModel;
		}
		
		public function createarticle($id = null){
			$this->viewModel->set('pageTitle', 'Написать статью');
			
			return $this->viewModel;
		}
		
		public function checkarticle($id = null){
			$this->viewModel->set('pageTitle', 'Проверка статьи');	
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
			
			if (!empty($_POST['comment'])){
				if (strlen($_POST['comment'])>300){
					$commenterror =  "<font size=\"3\" color=\"red\">Длина комментария не должна превышать 100 символов!</font>";
				}
				else{
					$text = $_POST['comment'];
					$date = date("Y-m-d H:i:s");
					$userId = $_SESSION['Id'];
			
					$comment = mysqli_query($db,"INSERT INTO comments (Text, Datetime, UserId, ArticleId) VALUES('$text','$date','$userId','$id')");
				}
			}
			
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
				header('Location: /User/');
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
			 	header('Location: /User/');
			}  
			 return $this->viewModel;  
		}
		public function deletearticle($id = null){
			$this->viewModel->set('pageTitle', 'Удаление');
			$db = MVC\Config\DbConfig::getConnection();
			session_start();
				
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
				
			$selectedArticle = mysqli_query($db,"SELECT * FROM articles WHERE Id='$id';");
			$articleRow = mysqli_fetch_array($selectedArticle);
			
			if ($articleRow['Userid']==$_SESSION['Id']){
				$articleId = $articleRow['Id'];
			
				$row2 = mysqli_query($db,"SELECT * FROM comments WHERE ArticleId='$articleId';");
				$num_result = mysqli_num_rows($row2);
				$allResults = array();
				// Выводим все записи текущей страницы
				for ($i = 0; $i<$num_result; $i++) {
					$allResults[] = mysqli_fetch_array($row2);
				}
				foreach ($allResults as $row){
					$result2 = mysqli_query($db, "DELETE FROM comments WHERE ArticleId='$articleId' ");
				}
			
				$result = mysqli_query($db, "DELETE FROM articles WHERE Id='$articleId' ");
				if($result==TRUE){
					$state = "<font size=\"6\" color=\"green\">Удаление выполнено успешно!</font><br /><b>Перейти на <a href='/User/index'>главную страницу</a></b>";
				}
				else{
					$state = "<font size=\"6\" color=\"red\">Возникла ошибка при удалении</font><br /><b>Перейти на <a href='/User/index'>главную страницу</a></b>";
				}
			}
			else{
				$state = "<font size=\"6\" color=\"red\">Ошибка</font><br /><b>Перейти на <a href='/User/index'>главную страницу</a></b>";
			}
			
			$this->viewModel->set('state', $state);
			return $this->viewModel;
		}
		
		public function changearticle($id = null){
			$this->viewModel->set('pageTitle', 'Изменение');
			$db = MVC\Config\DbConfig::getConnection();
			session_start();
				
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
				
			$selectedArticle = mysqli_query($db,"SELECT * FROM articles WHERE Id='$id';");
			$articleRow = mysqli_fetch_array($selectedArticle);
			$this->viewModel->set('articleRow', $articleRow);
			
			
			return $this->viewModel;
		}
		
		public function deletecomment($id = null){
			$this->viewModel->set('pageTitle', 'Удаление комментария');
			$db = MVC\Config\DbConfig::getConnection();
			session_start();
			
			// запрещаем вывод предупреждений
			Error_Reporting(E_ALL & ~E_NOTICE);
			
			$selectedComment = mysqli_query($db,"SELECT * FROM comments WHERE Id='$id';");
			$commentRow = mysqli_fetch_array($selectedComment);
			if ($commentRow['UserId']==$_SESSION['Id']){
				$result = mysqli_query($db, "DELETE FROM comments WHERE Id='$id' ");
				if ($result==TRUE){
					header('Location: /User/article/'.$commentRow['ArticleId']);
				}
				else{
					echo "<font size=\"6\" color=\"red\">Возникла ошибка при удалении комментария</font><br /><b>Перейти на <a href='/User/index'>главную страницу</a></b>";
				}
			}
			else{
				echo "<font size=\"6\" color=\"red\">Ошибка</font><br /><b>Перейти на <a href='/User/index'>главную страницу</a></b>";
			}
			
			return $this->viewModel;
		}
		
		public function logout($id = null){
			$this->viewModel->set('pageTitle', 'Выход');
			
			return $this->viewModel;
		}

	}
?>