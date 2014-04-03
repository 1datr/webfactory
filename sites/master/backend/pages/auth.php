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
	?>
	<form method="post">
	<?php 
	if(!empty($_ARGS['requri']))
		$requri = $_ARGS['requri'];
	else 
		$requri = "index";
	?>
	<input type="hidden" name="requri" value="<?php echo $requri; ?>" />
	<table>
	
	<tr><th>Логин</th><td><input type="text" name="login" /></td></tr>
	<tr><th>Пароль</th><td><input type="password" name="passw" /></td></tr>
	<tr><td colspan="2"><input type="checkbox" name="remember" />&nbsp;Запомнить</td></tr>
	<tr><th></th><td><input type="submit" value="Войти" /></td></tr>
	</table>
	</form>
</body>

</html>