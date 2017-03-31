<?php 
			
			//заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную(делаем со всеми полями)
			if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
			if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
			if (isset($_POST['confirmpassword'])) { $confirmpassword=$_POST['confirmpassword']; if ($confirmpassword =='') { unset($confirmpassword);} }
			//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
			if (empty($login) or empty($password) or empty($confirmpassword))
			{
				exit ("<font size=\"6\" color=\"red\">Вы ввели не всю информацию, вернитесь назад и заполните все поля!</font><br />Вернуться на страницу <a href='/Home/Register'>регистрации</a>");
			}
			if($password!=$confirmpassword){
				exit ("<font size=\"6\" color=\"red\">Пароли не совпадают!</font><br />Вернуться на страницу <a href='/Home/Register'>регистрации</a>");
			}
			//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
			$login = stripslashes($login);
			$login = htmlspecialchars($login);
			$password = stripslashes($password);
			$password = htmlspecialchars($password);
			$confirmpassword = stripslashes($confirmpassword);
			$confirmpassword = htmlspecialchars($confirmpassword);
			
			//удаляем лишние пробелы
			$login = trim($login);
			$password = trim($password);
			$confirmpassword = trim($confirmpassword);
			if (strlen($login)>30 || strlen($login)<4){
				echo "<br/>";
				exit ("<font size=\"6\" color=\"red\">Введеный вами логин должен быть в длину от 4 до 30 символов</font><br /><b>Вернуться на <a href='/Home/Register'>страницу регистрации</a></b>");
			}
			if (strlen($password)>12 || strlen($password)<6){
				echo "<br/>";
				exit ("<font size=\"6\" color=\"red\">Введеный вами пароль должен быть в длину от 6 до 12 символов</font><br /><b>Вернуться на <a href='/Home/Register'>страницу регистрации</a></b>");
			}
			$date = date("Y-m-d");
			$avatar = "/img/avatars/noavatar.jpg";
			//хешируем пароль
			$password = password_hash($password, PASSWORD_BCRYPT);
			// проверка на существование пользователя с таким же логином
			$result = mysqli_query($db, "SELECT id FROM users WHERE Login='$login'");
			$myrow = mysqli_fetch_array($result);
			if (!empty($myrow['id'])) {
				echo "<br/>";
				exit ("<font size=\"6\" color=\"red\">Введеный вами логин уже зарегистрирован, введите другой!</font><br /><b>Вернуться на <a href='/Home/Register'>страницу регистрации</a></b>");
			}
			
			// если такого нет, то сохраняем данные
			$result2 = mysqli_query($db,"INSERT INTO users (Login, Password, Role, Date, Avatar, Isbanned) VALUES('$login','$password','автор','$date','$avatar', FALSE)");
			
			// Проверяем, есть ли ошибки
			if ($result2=='TRUE')
			{
				echo "<br />";
				echo "<font size=\"9\" color=\"green\">Вы успешно зарегистрированы!</font><br /><b> Теперь вы можете зайти на <a href='/Home/Login'>сайт</a></b>";
			}
			else {
				echo "<br />";
				echo "<font size=\"6\" color=\"red\">Ошибка! Вы не зарегистрированы!</font><br /><b>Вернуться на <a href='/Home/Register'>страницу регистрации</a></b>";
			}
			?>