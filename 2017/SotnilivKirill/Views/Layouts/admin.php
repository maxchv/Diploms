<?php 
	session_start();
	$db = MVC\Config\DbConfig::getConnection();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- podkluchenie API VK -->
    <script src="https://vk.com/js/api/openapi.js?142" type="text/javascript"></script>
    <script type="text/javascript" src="https://vk.com/js/api/share.js?94" charset="windows-1251"></script>
	<script type="text/javascript">
	  VK.init({
	    apiId: 	5959325,
	    onlyWidgets: true
	  });
	</script>
	
	<style type="text/css">
	div .container123{
	 width: 100%;
  	 max-width: 750px;
 	 margin: 0 auto;
	}
	img{
		max-width: 100%;
	    max-height: 450px;
	}
	</style>
    <meta  charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='/static/css/bootstrap.css' rel="stylesheet" type="text/css" >
    <link href='/static/css/site.css' rel="stylesheet" type="text/css" >
    <script src="/ckeditor/ckeditor.js"></script>
    <title><?php echo $viewModel->get('pageTitle'); ?></title>
    
</head>
<body>
	<header>
		 <div class="navbar navbar-inverse navbar-fixed-top">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	            </div>
	            <div class="navbar-collapse collapse">
	                <ul class="nav navbar-nav">
	               						 <!--   action,name,controller -->
	                	<li><?php MVC\Helpers\Html::actionLink("index", "Главная", "Admin") ?></li>
	                	<li><?php MVC\Helpers\Html::actionLink("about", "FAQ", "Admin") ?></li>
	                	<li><?php MVC\Helpers\Html::actionLink("contact", "Контакты", "Admin") ?></li>
	                	<li><?php MVC\Helpers\Html::actionLink("profile", "Профиль", "Admin") ?></li>
	                	<li><?php MVC\Helpers\Html::actionLink("createarticle", "Написать статью", "Admin") ?></li>
	                	<li><?php MVC\Helpers\Html::actionLink("adminpanel", "Администрирование", "Admin") ?></li>
	                </ul>
	                <ul class="nav navbar-nav navbar-right">
	               		<li><?php
							if (empty($_SESSION['Login']) or empty($_SESSION['Id']))
							{
								header('Location: /Home/');
							}
							else
							{
								if($_SESSION['Role']!='админ'){
									header('Location: /User/');		
								}
								else{
									echo "<a>Вы вошли на сайт, как ".$_SESSION['Login']."</a>";
								}	
							}?></li>
							<li><?php MVC\Helpers\Html::actionLink("logout", "Выход", "Admin") ?></li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</header>
   
   <div class="container body-content">
     <div class="row">
        <div style="background-color:white; margin-top:20px;" class="col-md-8">
        <!-- @RenderBody() -->
        <?php
        	require $this->viewFile;
        ?>
        </div>
        <!--         SIDE BAR    SIDE BAR   SIDE BAR            -->
        <div class="col-md-4">
            	<form action="/Blog/Admin/search" method="post">
	            	<div style="margin-top:20px;" class="well">
				        <div class="form-inline text-center">
		                <input type="text" name="search" style="width:230px;" class="form-control" placeholder="Поиск">
		                <button type="submit" class="btn btn-default">Искать</button>
			            </div>
				    </div>
            	</form>
			    
			    
			    <!-- Other widgets -->
			    <div class="panel panel-default">
				    <div class="panel-heading">
				        <h4>Последние статьи</h4>
				    </div>
				    <ul class="list-group">
				    	<?php 
				    	$i=0;
				    	$query=mysqli_query($db, "SELECT * FROM articles ORDER BY Id DESC");
				    	while ($someresult=mysqli_fetch_array($query))
				    	{	
				    		$i++;
				    		$header = $someresult['Header'];
				    		if ($i==5){
				    			break;
				    		}?>
				    		<li class="list-group-item"><?php MVC\Helpers\Html::actionLink("article", $i.'. '.$header , "Admin", $someresult['Id'] , ["class" => ""])?></li>	
				    		<?php 			    		
				    	}
				    	?>
				    </ul>
				</div>
				
				<div class="panel panel-default">
			    <div class="panel-heading">
			        <h4>Категории</h4>
			    </div>
			    <ul class="list-group">
			    	<?php 
			    	$query2=mysqli_query($db, "SELECT * FROM categories");
			    	echo "<form action=\"/Admin/selectedcategory\" method=\"post\">";
			    	while ($someresult2=mysqli_fetch_array($query2))
			    	{	$category = $someresult2['Name'];
			    		echo "<li class=\"list-group-item\">";
			    		echo "<input style=\"width:100%;\" class=\"btn\" type=\"submit\" name=\"categoryName\" value=".$category.">";
			    		echo "</li>";
			    	}
			    	echo "</form>";
			    	?>    
			       
			    </ul>
				</div>
				
				
        </div>
    	</div>
    </div>
    
    <footer>
	    <div class="container">
	        <hr />
	        <p class="text-center">Автор © Сотников Кирилл. Все права защищены.</p>
	    </div>
    </footer>

	<script src="/static/js/jquery-1.10.2.js"></script>
	<script src="/static/js/bootstrap.js"></script>
	<script src="/static/js/respond.js"></script>
</body>
</html>
