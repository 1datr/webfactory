<?php 
if($_SESSION['authed'])
	redirect(geturl(null,"index",$_SITE,$_ENTERPOINT));
head("�����������");
 
	$error = "";
	if((!empty($_POST['login'])) && (!empty($_POST['passw'])))
	{
		if(($_POST['login'] == $_USER)&&($_POST['passw']==$_PASSWORD))
		{
			$_SESSION['authed']=true;
			redirect(geturl(null,"index",$_SITE,$_ENTERPOINT));
		}
		else 
		{
			$error = "Wrong login or password";
			
		}
	}
	?>
	<form method="post">
	<table>
	<tr><th>�����</th><td><input type="text" name="login" /></td></tr>
	<tr><th>������</th><td><input type="password" name="passw" /></td></tr>
	<tr><td colspan="2"><input type="checkbox" name="remember" />&nbsp;���������</td></tr>
	<tr><th></th><td><input type="submit" value="�����" /></td></tr>
	</table>
	</form>
</body>

</html>