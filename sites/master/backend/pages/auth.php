<?php 
if($_SESSION['authed'])
	redirect(geturl(null,"index",$_SITE,$_ENTERPOINT));
head("Авторизация");
 
	$error = "";
	if((!empty($_POST['login'])) && (!empty($_POST['passw'])))
	{
		if(($_POST['login'] == $_USER)&&($_POST['passw']==$_PASSWORD))
		{
			$_SESSION['authed']=true;
			$url_to = $_POST['requri'];
			redirect($_SESSION['REDIRECT_URL']);
		}
		else 
		{
			$error = "Wrong login or password";
			
		}
	}
	
	//print_r($_ARGS);

	if(!empty($_ARGS['requri']))
		$requri = $_ARGS['requri'];
	else
		$requri = "index";
	
	?>
	<div class="container">
    <div class="row">
		<div class="span4 offset4 well">
			<input type="hidden" name="requri" value="<?php echo $requri; ?>" />
			<legend>Авторизация</legend>
			<?php 
			if(!empty($error))
			{
				?>
				<div class="alert alert-error">
				     <a class="close" data-dismiss="alert" href="#">x</a><?php echo $error; ?>
				</div>
				<?php 
			}
			?>
          	
			<form method="POST" action="" accept-charset="UTF-8">
			<input type="text" id="username" class="span4" name="login" placeholder="Логин">
			<input type="password" id="password" class="span4" name="passw" placeholder="Пароль">
            <label class="checkbox">
            	<input type="checkbox" name="remember" value="1"> Запомнить
            </label>
			<button type="submit" name="submit" class="btn btn-info btn-block">Войти</button>
			</form>    
		</div>
	</div>
	</div>
	
	

</body>

</html>