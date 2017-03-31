<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<h4>Создайте новый аккаунт</h4>
<hr />

<form class="form-horizontal" role="form" method="post" action="/Home/checkRegister" >
        <div class="form-group">
              <label for="inputLogin" class="control-label col-md-2">Логин</label>
              <div class="col-md-10">
                <input type="text" name="login" class="form-control" id="inputLogin" placeholder="Логин">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="control-label col-md-2">Пароль</label>
              <div class="col-md-10">
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Пароль">
              </div>
            </div>
            <div class="form-group">
              <label for="confirmPassword" class="control-label col-md-2">Подтвердите пароль</label>
              <div class="col-md-10">
                <input type="password" name="confirmpassword" class="form-control" id="confirmPassword" placeholder="Подтвердите пароль">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn btn-primary">Зарегистрировать</button>
              </div>
        </div>
</form>


