<?php 
$mysqli = MVC\Config\DbConfig::getConnection();
mysqli_set_charset($mysqli, "utf8");
				
			if (!empty($_POST['header'])&&!empty($_POST['category'])&&!empty($_POST['article'])){
				if (strlen($_POST['header'])>50){
					echo "<font size=\"5\" color=\"red\">Ошибка! Превышен лимит длины заголовка!</font><br /><b>Вернуться на страницу <a href='/Admin/createarticle'>оформления статьи</a></b>";
				}
				elseif(strlen($_POST['article'])>3000){
					echo "<font size=\"5\" color=\"red\">Ошибка! Превышен лимит длины статьи!</font><br /><b>Вернуться на страницу <a href='/Admin/createarticle'>оформления статьи</a></b>";
				}
				else{
					$header = $_POST['header'];
					$textarea = $_POST['article'];
					$date = date("Y-m-d H:i:s");
					$userid =  $_SESSION['Id'];
					$category = $_POST['category'];
						
					$res = $mysqli->query("SELECT Id FROM categories WHERE Name='$category'");
					$row = $res->fetch_assoc();
					$categoryid = $row['Id'];
					//сохранение данных
					$stmt = $mysqli->prepare("INSERT INTO articles (Header, Article, Datetime, Userid, CategoryId) VALUES(?,?,?,?,?)");
					$stmt->bind_param("sssii",$header,$textarea,$date,$userid,$categoryid);
					$stmt->execute();
					echo "<font size=\"6\" color=\"green\">Статья успешно создана!</font><br /><b>Перейти на <a href='/Admin/index'>главную страницу</a></b>";
				}
			}
			elseif (!empty($_POST['changeheader'])&&!empty($_POST['changecategory'])&&!empty($_POST['changearticle'])){
				if (strlen($_POST['changeheader'])>50){
					echo "<font size=\"5\" color=\"red\">Ошибка! Превышен лимит длины заголовка!</font><br /><b>Вернуться на страницу <a href='/Admin/createarticle'>оформления статьи</a></b>";
				}
				elseif(strlen($_POST['changearticle'])>2000){
					echo "<font size=\"5\" color=\"red\">Ошибка! Превышен лимит длины статьи!</font><br /><b>Вернуться на страницу <a href='/Admin/createarticle'>оформления статьи</a></b>";
				}
				else{
					$header = $_POST['changeheader'];
					$textarea = $_POST['changearticle'];
					$date = date("Y-m-d H:i:s");
					$userid =  $_SESSION['Id'];
					$category = $_POST['changecategory'];
						
					$res = $mysqli->query("SELECT Id FROM categories WHERE Name='$category'");
					$row = $res->fetch_assoc();
					$categoryid = $row['Id'];	
					$articleId =  $_POST['articleId'];
					
					
					//сохранение данных
					$add = "UPDATE articles SET Header = '$header', Article = '$textarea', Datetime = '$date', Userid = '$userid', CategoryId = '$categoryid' WHERE Id='$articleId'";
                    $stmt = $mysqli->prepare($add);
					$stmt->execute();

					echo "<font size=\"6\" color=\"green\">Статья успешно обновлена!</font><br /><b>Перейти на <a href='/Admin/index'>главную страницу</a></b>";
				}
					
			}
			else{
				echo "<font size=\"6\" color=\"red\">Ошибка! Не все поля заполнены!</font><br /><b>Вернуться на страницу <a href='/Admin/createarticle'>оформления статьи</a></b>";
			}
				
			/* &&preg_match('/^[а-яА-Яa-zA-Z0-9]+$/u',$_POST['article']) */
?>