<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<hr style=" border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);">
<br/>

<form class="form-horizontal" role="form" method="post" action="">
    <div class="form-horizontal form-group">
        <label for="oldpassword" class="control-label col-md-4">Введите старый пароль</label>
        <div class="col-md-5">
            <input type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="Пароль">
        </div>
    </div>
    <div class="form-group">
        <label for="newpassword" class="control-label col-md-4">Введите новый пароль</label>
        <div class="col-md-5">
            <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Новый пароль">
        </div>
    </div>
    <div class="form-group">
        <label for="confirmnewpassword" class="control-label col-md-4">Подтвердите новый пароль</label>
        <div class="col-md-5">
            <input type="password" name="confirmnewpassword" class="form-control" id="confirmnewpassword"
                   placeholder="Подтвердите пароль">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" name="changepass" class="btn btn-primary">Сохранить новый пароль</button>
        </div>
    </div>
</form>

<?php
$state = $viewModel->get('state');
echo $state;
?>