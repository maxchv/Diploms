<h2><?php echo $viewModel->get('pageTitle'); ?></h2>
<h4>Используйте созданный вами аккаунт, чтобы войти</h4>
<hr />

<form class="form-horizontal" action="http://blogdiplom.zzz.com.ua/Home/checkLogin" role="form" method="post" >
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
<!--             <div class="form-group"> -->
<!--               <div class="col-md-offset-2 col-md-10"> -->
<!--                 <div class="checkbox"> -->
<!--                   <label><input type="checkbox"> Remember me</label> -->
<!--                 </div> -->
<!--               </div> -->
<!--             </div> -->
            <div class="form-group">
              <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn btn-primary">Войти</button>
              </div>
            </div>
            <div class="form-group">
              <div class="control-label col-md-3">
                <a href="http://blogdiplom.zzz.com.ua/Home/Register">Создать новый аккаунт</a>
              </div>
            </div>
</form>