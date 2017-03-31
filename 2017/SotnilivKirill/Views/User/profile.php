<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<?php 
$id = $viewModel->get('id');
$login = $viewModel->get('login');
$role = $viewModel->get('role');
$date = $viewModel->get('date');
$avatar = $viewModel->get('avatar');
?>
<hr style=" border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);">


<div style="background-color:white; margin-top:-20px; width:100%; height:620px;">
			<form role="form" enctype="multipart/form-data" method="post" action="">
			
				   <div class="form-group">
		              <div class="form-inline text-center col-md-11">
		              	<h3><p>Ваше имя: <?php echo $login ?></p></h3>
		                <h3><p>Ваш аватар: <img width="90"; height="90"; border= alt="userPicture" src="/static/<?php echo $avatar ?>"></p></h3>
		                <h3><p>Дата регистрации: <?php echo $date ?></p></h3>
		                <h3><p>Ваш статус: <?php echo $role ?></p></h3>
		              </div>
		            </div>
            
            		
	            	<div style="margin-top:100px; width:100%;" class="col-md-11">
				        <div class="form-inline ">
				        <hr style=" border: 0;
								 height: 1px;
								 background: #333;
								 background-image: linear-gradient(to right, #ccc, #333, #ccc);">
								 
		                 <label>Выберите аватар. Изображение должно быть формата jpg или png:<br></label>
		                 <input type="FILE" name="avatarka" multiple accept="image/jpeg,image/png">
		                 <br />
		                 <button type="submit" name="btn1" class="btn btn-primary">Загрузить</button>
		                 
		                 <?php
			                 if(@$_FILES["avatarka"]["size"] > 1024*5*1024)
			                 {
			                 	echo ("Размер файла превышает пять мегабайт");
			                 	exit;
			                 }
			                 // Проверяем загружен ли файл
			                 if(is_uploaded_file(@$_FILES["avatarka"]["tmp_name"]))
			                 {
			                 	$file = $_FILES["avatarka"]["name"];
			                 	// Если файл загружен успешно, перемещаем его
			                 	// из временной директории в конечную
			                 	move_uploaded_file($_FILES["avatarka"]["tmp_name"], "/profiles/m/ma/max/maxchv/blogdiplom.zzz.com.ua/static/img/avatars/".$_FILES["avatarka"]["name"]);
			                 	$result = mysqli_query($db,"UPDATE users SET Avatar ='img/avatars/$file' WHERE id = '$id'");
			                 	$result2 = mysqli_query($db,"SELECT * FROM users WHERE id='$id'");
			                 	$myrow = mysqli_fetch_array($result2);
			                 	unset($_SESSION['Avatar']);
			                 	$_SESSION['Avatar'] = $myrow['Avatar'];
			                 	if ($result==TRUE){
			                 		echo("Файл успешно загружен!");
			                 	} 
			                 	else{
			                 		echo("Ошибка записи файла в бд");
			                 	}
			                 } else {
			                 	echo("Ошибка загрузки файла");
			                 }
		                 
		                 ?>             
			            </div>
				    </div>
            	</form>
            	<form role="form" method="post" action="/User/changepassword">
            	     <div style="width:100%;" class="col-md-11">
				        <div class="form-inline ">
	            			 <br />
			                 <hr style=" border: 0;
								 height: 1px;
								 background: #333;
								 background-image: linear-gradient(to right, #ccc, #333, #ccc);">
	                		 <button type="submit" name="btn2" class="btn btn-primary">Изменить пароль</button>
                		 </div>
                	 </div>
            	</form>
            	      
</div>
