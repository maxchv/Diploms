<?php
$db = MVC\Config\DbConfig::getConnection();
$articleRow =  $viewModel->get('articleRow');
$allCommentsResults = $viewModel->get('allCommentsResults');
$userrow = $viewModel->get('userrow');
$categoryrow = $viewModel->get('categoryrow');
?>

<article>
		<h2><?php echo $articleRow['Header'] ?></h2>
		<div class="row">
		<div class="group1 col-sm-6 col-md-6">
		<span class="glyphicon glyphicon-user"></span> Автор:
		<?php echo $userrow["Login"] ?>
		<img width="30"; height="30"; alt="userPicture" src="/static/<?php echo $userrow['Avatar'] ?>">
		&nbsp;
		<span class="glyphicon glyphicon-bookmark"></span> Категория:
		<?php echo $categoryrow["Name"] ?>
		</div>
		<div class="group2 col-sm-6 col-md-6">
		<div class="pull-right"><?php echo "&nbsp;".$articleRow["Datetime"] ?></div><span class="glyphicon glyphicon-time pull-right"></span>
		</div>
		</div>
		<hr>
		<br />
		
		<div class="container123" style=" word-wrap:break-word;"><?php echo $articleRow["Article"] ?></div>
		
		<div class="pull-left">
		<b>Поделиться записью:</b>
		<script type="text/javascript"><!-- 
		document.write(VK.Share.button({url: 'http://blogdiplom.zzz.com.ua', title: 'Blog'},{type: "custom", text: "<img src=\"https://vk.com/images/share_32.png\" width=\"32\" height=\"32\" />"}));
		--></script>
		</div>
		
		<div class="pull-right">
		<?php
			
			if($articleRow['Userid']==$_SESSION[Id]){
				$rowId = $articleRow['Id'];
				MVC\Helpers\Html::actionLink("changearticle", "изменить статью", "Admin", $rowId, ["class" => ""]);
				echo "&nbsp;|&nbsp;";
				MVC\Helpers\Html::actionLink("deletearticle", "удалить статью", "Admin", $rowId, ["class" => ""]);
			}
		?>
		</div>
		<br/>
		<hr style=" border: 0;
		    height: 1px;
		    background: #333;
		    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
		
</article>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<h3>Комментарии:</h3>
<hr style=" border: 0;
		    height: 1px;
		    background: #333;
		    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
<ul id="comments" class="comments">
<?php foreach ($allCommentsResults as $commentRow) { 
		$userId = $commentRow['UserId'];
		// Делаем запрос
			$result = mysqli_query($db,"SELECT * FROM users WHERE id='$userId'");
			// Считаем количество полученных записей
			$userRow = mysqli_fetch_array($result);?>
    <li class="comment">
        <div class="clearfix">
        	<img class="pull-left" width="30"; height="30"; alt="userPicture" src="/blog/static/<?php echo $userRow['Avatar'] ?>">
            <h4 class="pull-left" ><?php echo "&nbsp;".$userRow['Login'] ?></h4>    
            <p class="pull-right"><?php echo "&nbsp;".$commentRow['Datetime'] ?></p>
            <span class="glyphicon glyphicon-time pull-right"></span>
        </div>
        <p cols="20">
            <em style=" word-wrap:break-word;"><?php echo $commentRow['Text'] ?></em>     
        </p>
        <div class="pull-right">
		<?php		
				$rowId = $commentRow['Id'];
				MVC\Helpers\Html::actionLink("deletecomment", "удалить комментарий", "Admin", $rowId, ["class" => ""]);
		?>
		</div>
		<br/>
       <hr style=" border: 0;
		    height: 1px;
		    background: #333;
		    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
    </li>
 <?php } ?>
    
</ul>

<div class="well">
<?php 
$commenterror = $viewModel->get('commenterror');
echo $commenterror;
?>
    <h4>Оставьте комментарий</h4>
 
    <form method="post" action="" role="form" class="clearfix">
        <div class="col-md-12 form-group">
            <textarea style="resize: none;" class="form-control" name="comment" id="comment" placeholder="Комментарий"></textarea>
        </div>
 
        <div class="col-md-12 form-group text-right ">
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
</div>

<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*"});
</script>
</br>

