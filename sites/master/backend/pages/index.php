<?php 
head("Проекты");

$projdir = scandir(sitedir()."$_ENTERPOINT/projects");

if(!empty($_POST['newprojname']))
{
	mkdir(sitedir()."$_ENTERPOINT/projects/".$_POST['newprojname']);
	file_put_contents(sitedir()."$_ENTERPOINT/projects/".$_POST['newprojname']."/index.php", "<?php ?>");	
	redirect($_SERVER['HTTP_REFERER']);
}
if(!empty($_POST['delproj']))
{
	rrmdir(sitedir()."$_ENTERPOINT/projects/".$_POST['delproj']);
	redirect($_SERVER['HTTP_REFERER']);
}
?>
<div class="row">
	<div class="page-header">
	 
	<h1>Проекты</h1>
	</div>
</div>

<div class="row">
<div class="span4">
<table class="table">
<?php
foreach($projdir as $proj)
{
	//echo sitedir()."$_ENTERPOINT/projects/$proj";
	if(($proj!='.')&&($proj!='..')&&(is_dir(sitedir()."$_ENTERPOINT/projects/$proj")))
			echo "
		<tr>
			<td><a href=\"".getownurl(Array($proj),"project")."\">$proj</a></td>
			<td><form class=\"frm_delproj\" method=\"post\">
			<button type=\"submit\" class=\"btn btn-inverse btn-small\"><i class=\"icon-white icon-remove-sign\"></i> Удалить</button>
			
			<input type=\"hidden\" name=\"delproj\" value=\"$proj\"></form></td>
		</tr>";
}
?>
</table>

<form method="post" action=""> 
<div class="col-xs-6 col-md-6">
	<div class="input-group-btn">
            <input type="text" class="form-control" class="form-control input-lg" name="newprojname" placeholder="Новый проект" name="q">
            <button type="submit" class="btn btn-success btn-small"><i class="icon-white icon-plus-sign"></i> Создать</button>
    </div>
</div>
</form>

</div>
</div>

</body>
</html>