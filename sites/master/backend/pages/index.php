
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
<h2>ПРОЕКТЫ</h2>
<table class="projects">
<?php
foreach($projdir as $proj)
{
	//echo sitedir()."$_ENTERPOINT/projects/$proj";
	if(($proj!='.')&&($proj!='..')&&(is_dir(sitedir()."$_ENTERPOINT/projects/$proj")))
			echo "
		<tr>
			<td><a href=\"".getownurl(Array($proj),"project")."\">$proj</a></td>
			<td><form class=\"frm_delproj\" method=\"post\"><input type=\"submit\" value=\"Удалить\" /><input type=\"hidden\" name=\"delproj\" value=\"$proj\"></form></td>
		</tr>";
}
?>
</table>
<form method="post" action=""> 
<input type="text" name="newprojname" /><input type="submit" value="Add project" />
</form>

</body>
</html>