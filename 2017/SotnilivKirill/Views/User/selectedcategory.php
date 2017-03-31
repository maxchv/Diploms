<?php
//Вывод статей
$allResults = $viewModel->get('allResults');
foreach ($allResults as $row) {
	$categoryId = $row['CategoryId'];
	$result = mysqli_query($db,"SELECT * FROM categories WHERE Id='$categoryId'");
	$categoryrow = mysqli_fetch_array($result);

	$userId = $row['Userid'];
	$result2 = mysqli_query($db,"SELECT * FROM users WHERE id='$userId'");
	$userrow = mysqli_fetch_array($result2);
	?>
		
		
		<article>
		<?php MVC\Helpers\Html::actionLink("article", "<h2>".$row['Header']."</h2>" , "User", $row['Id'] , ["class" => ""]);?>
		<div class="row">
		<div class="group1 col-sm-6 col-md-6">
		<span class="glyphicon glyphicon-user"></span> Автор:
		<?php echo $userrow["Login"] ?>
		<img width="30"; height="30"; alt="userPicture" src="/blog/static/<?php echo $userrow['Avatar'] ?>">
		&nbsp;
		<span class="glyphicon glyphicon-bookmark"></span> Категория:
		<?php echo $categoryrow["Name"] ?>
		</div>
		<div class="group2 col-sm-6 col-md-6">
		<!-- <span class="glyphicon glyphicon-pencil"></span> <a href="singlepost.html#comments">20 Comments</a> -->
		<div class="pull-right"><?php echo "&nbsp;".$row["Datetime"] ?></div><span class="glyphicon glyphicon-time pull-right"></span>
		</div>
		</div>
		
		<hr>
		
		<!-- поле для будущей реализации показа картинки -->
		<!-- <img src="http://placehold.it/900x300" class="img-responsive"> -->
		
		<br />
		<div class="container123" style=" word-wrap:break-word;"><?php echo $row["Article"] ?></div>
		<div class="pull-right">
		<?php	
			if($row['Userid']==$_SESSION[Id]){
				$rowId = $row['Id'];
				MVC\Helpers\Html::actionLink("changearticle", "изменить статью", "User", $rowId, ["class" => ""]);
				echo "&nbsp;|&nbsp;";
				MVC\Helpers\Html::actionLink("deletearticle", "удалить статью", "User", $rowId, ["class" => ""]);
			}
		?>
		</div>
		<br/>
		<hr style=" border: 0;
		    height: 1px;
		    background: #333;
		    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
		
		</article>
		<?php 
	} 

	
	
	
// Алгоритм перехода по страницам
echo "<font size=\"5\">".'Страницы: '."</font>";
// _________________ начало блока 1 _________________
$page = $viewModel->get('page');
$pages = $viewModel->get('pages');
	
// Выводим ссылки "назад" и "на первую страницу"
if ($page>=1) {

    // Значение page= для первой страницы всегда равно единице, 
    // поэтому так и пишем
	MVC\Helpers\Html::actionLink("selectedcategory", "<font size=\"5\"><< </font>", "User", 1, ["class" => ""]);

    // Так как мы количество страниц до этого уменьшили на единицу, 
    // то для того, чтобы попасть на предыдущую страницу, 
    // нам не нужно ничего вычислять
	MVC\Helpers\Html::actionLink("selectedcategory", "<font size=\"5\"><</font>", "User", $page, ["class" => ""]);
}
// __________________ конец блока 1 __________________
$limit = $viewModel->get('limit');

// На данном этапе номер текущей страницы = $page+1
$thispage = $page+1;

// Узнаем с какой ссылки начинать вывод
$start = $thispage-$limit;

// Узнаем номер последней ссылки для вывода
$end = $thispage+$limit;

// Выводим ссылки на все страницы
// Начальное число $j в нашем случае должно равнятся единице, а не нулю
for ($j = 1; $j<$pages; $j++) {

    // Выводим ссылки только в том случае, если их номер больше или равен
    // начальному значению, и меньше или равен конечному значению
    if ($j>=$start && $j<=$end) {

        // Ссылка на текущую страницу выделяется жирным
    	if ($j==($page+1)){
    		MVC\Helpers\Html::actionLink("selectedcategory", "<font size=\"5\" color=\"black\">".$j." </font>", "User",$j, ["class" => ""]);
    	}
        
        // Ссылки на остальные страницы
    	else {
    		MVC\Helpers\Html::actionLink("selectedcategory", " "."<font size=\"5\">".$j." </font>"." ", "User", $j, ["class" => ""]);
    	}
    }
}

// _________________ начало блока 2 _________________

// Выводим ссылки "вперед" и "на последнюю страницу"
if ($j>$page && ($page+2)<$j) {

    // Чтобы попасть на следующую страницу нужно увеличить $pages на 2
    MVC\Helpers\Html::actionLink("selectedcategory", "<font size=\"5\">></font>", "User", $page+2, ["class" => ""]);
    // Так как у нас $j = количество страниц + 1, то теперь 
    // уменьшаем его на единицу и получаем ссылку на последнюю страницу
    MVC\Helpers\Html::actionLink("selectedcategory", "<font size=\"5\"> >></font>", "User", $j-1, ["class" => ""]);
}

// __________________ конец блока 2 __________________ 
echo "<br/><br/>";
?>
    