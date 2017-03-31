<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<hr style=" border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
    
<style type="text/css">
    table {
        border-collapse: collapse;
    }
    table th,
    table td {
        padding: 0 3px;
    }
    table.brd th,
    table.brd td {
        border: 3px solid grey;
    }
</style>


<div style="background-color:white; margin-top:-20px; width:100%; height:620px;">
<br/>
				<form role="form"  method="POST"  class="form-horizontal col-md-12">
				
				<div style="margin:0 auto;" class="form-group">
				<label class="col-md-8">Введите логин интересующего вас пользователя:</label>
	            	<div  style="margin:20px; width:400px; background-color:grey;" class="well">
				        <div  class=" form-inline text-center">
		                <input type="text" style="width:230px;" name="usersearch" class="form-control" placeholder="Поиск">
		                <button type="submit" name="searchbtn" class="btn btn-default">Искать</button>
			            </div>
				    </div>
				</div>	
            	</form>
            	
            	<?php 
            	$db = MVC\Config\DbConfig::getConnection();
				if (isset($_POST['usersearch']))
				{
					if (!empty($_POST['usersearch'])){				
						$login=$_POST['usersearch'];
						$_SESSION['Log']=$login;
						$result = mysqli_query($db,"SELECT * FROM users WHERE Login='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
						$myrow = mysqli_fetch_array($result);
						$secondRole='админ';
						$secondstate = 1;
						
						if ($myrow['Role']!='автор'){
							$secondRole = 'автор';
						}
						if ($myrow['Isbanned']!='0'){
							$secondstate = 0;
						}
						if (empty($myrow['Login']))
						{
							//если пользователя с введенным логином не существует
							echo ("<font size=\"5\" color=\"red\">Такого пользователя нет!</font>");
						}
						else
						{?>
						<form role="form" method="POST" class="form-horizontal col-md-12">
						<div class=" form-inline text-center">
							<h3>Пользователь существует:</h3>
							<table class="brd">
							<tr>
								<th>Id</th>
								<th>Логин</th>
								<th>Роль</th>
								<th>Дата Регистрации</th>
								<th>Состояние бана</th>
							</tr>
								<tr>
								<?php echo "<td>".$myrow['id']."</td><td>".$myrow['Login']."</td><td><select name=\"selectRole\" class=\"form-control\"><option>".$myrow['Role']."</option><option>".$secondRole."</option></select></td><td>".$myrow['Date']."</td><td><select name=\"selectStatus\" class=\"form-control\"><option>".$myrow['Isbanned']."</option><option>".$secondstate."</option></select></td>";?>
								</tr>
							</table>
							<button style="margin:20px;" name="saveuserbtn" type="submit" class="btn btn-primary">Сохранить изменения</button>
							</div>
						</form>	
							<?php 
						}
					}
				}
				
					if (isset($_POST['saveuserbtn'])/* &&isset($_POST['login']) */)
					{
						$login = @$_SESSION['Log'];
						$selectRole = $_POST['selectRole'];
						$selectStatus = $_POST['selectStatus'];
						//обновляем данные	
						$result2 = mysqli_query($db,"UPDATE users SET Role = '$selectRole'   WHERE Login = '$login'");
						$result3 = mysqli_query($db,"UPDATE users SET Isbanned = '$selectStatus'  WHERE Login = '$login'");
						// Проверяем, есть ли ошибки
						if ($result2=='TRUE'&&$result3=='TRUE')
						{
							echo "<font size=\"4\" color=\"green\">Сохранение выполнено!</font>";
							unset($_SESSION['Log']);
						}
						else {
							echo "<font size=\"4\" color=\"red\">Ошибка!</font>";
							unset($_SESSION['Log']);
						}
				}
				
				
				?>
</div>



