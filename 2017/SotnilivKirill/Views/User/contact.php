<!DOCTYPE html>
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>

<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<hr style=" border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
<br />


<br/>
<div style="background-color:white; margin-top:-40px; width:100%; height:490px;">
<div class="container">
    <div class="well">
        <p class="lead">
        	У вас есть какие-либо вопросы? Отправьте нам сообщение и мы постараемся ответить вам как можно скорее.
        </p>
    </div>
	
    <!-- contact form -->
    <div class="contact-form" id="contactFormArea">
    <form method="POST" class="form-horizontal col-md-12" id="feedback-form" action="" role="form">
 
        <div class="form-group">
            <label for="email" class="col-md-2">Ваш E-mail адрес:</label>
            <div class="col-md-10">
                <input type="email" size="25" class="form-control" name="email" required placeholder="Email">
            </div>
        </div>
        
        <div class="form-group">
            <label for="sub" class="col-md-2">Тема:</label>
            <div class="col-md-10">
                <input type="text" size="25" class="form-control" name="subject" required placeholder="Тема">
            </div>
        </div>
 
 
        <div class="form-group">
            <label for="message" class="col-md-2">Сообщение:</label>
            <div class="col-md-8">
                <textarea style="resize:none;" required rows="5" class="form-control" name="message" required placeholder="Сообщение"></textarea>
            </div>
        </div>
 
        <div class="form-group">
            <div class="col-md-10 text-right">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </form> 
</div>
<?php 
$state =  $viewModel->get('state');
echo $state;
?>
</div>
</div>


