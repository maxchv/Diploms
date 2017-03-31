<?php
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("<font size=\"6\" color=\"red\">Вы ввели не всю информацию, вернитесь назад и заполните все поля!</font><br />Вернуться на страницу <a href='/Home/Login'>входа</a>");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
//удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
   //подключаемся к БД
    $db = MVC\Config\DbConfig::getConnection();
 
	$result = mysqli_query($db,"SELECT * FROM users WHERE Login='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['Login']))
    {
    //если пользователя с введенным логином не существует(не даем потенциальному взломщику понять что именно он неправильно ввел)
    	echo "<br/>";
    	exit ("<font size=\"6\" color=\"red\">Введеный вами логин или пароль неверный!</font><br /><b>Вернуться на страницу <a href='/Home/Login'>входа</a></b>");
    }
    elseif ($myrow['Isbanned']==TRUE)
    {
    	echo "<br/>";
    	exit ("<font size=\"6\" color=\"red\">Доступ на сайт заблокирован!</font><br /><b>Вернуться на страницу <a href='/Home/Login'>входа</a></b>");
    }
    else {
    //если существует, то сверяем пароли
    if (password_verify($password, $myrow['Password'])) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    	$_SESSION['Id']=$myrow['id'];
	    $_SESSION['Login']=$myrow['Login']; 
	  	$_SESSION['Role']=$myrow['Role'];
	  	$_SESSION['Date']=$myrow['Date'];
	  	$_SESSION['Avatar']=$myrow['Avatar'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
	  	if($_SESSION['Role']=='админ'){
	  		echo "<br/>";
	  		echo "<font size=\"9\" color=\"green\">Вы успешно вошли на сайт!</font><br /><b>Войти на <a href='/Admin/index'>главную страницу</a></b>";
	  	}
	  	else{
	  		echo "<br/>";	
	  		echo "<font size=\"9\" color=\"green\">Вы успешно вошли на сайт!</font><br /><b>Войти на <a href='/User/index'>главную страницу</a></b>";
	  	}
	    
    }
 	else {
	    //если пароли не сошлись(не даем потенциальному взломщику понять что именно он неправильно ввел)
 		echo "<br/>";
	   	exit ("<font size=\"6\" color=\"red\">Введеный вами логин или пароль неверный!</font><br /><b>Вернуться на <a href='/Home/Login'>страницу входа</a></b>");
    }
    }
    ?>