<?php 
$proj = getarg(0, 'proj');

head($proj);
$wfapi_files = scandir(mydir()."/inc/wfapi");
foreach($wfapi_files as $file)
	if($file!='.'&& $file!='..')
		require_once mydir()."/inc/wfapi/".$file;
	
// load all default libs	
$_LIBS = Array();

foreach($LIBS as $lib)
	{

		if(file_exists(mydir()."/lib/$lib/index.php"))
		{
			require_once mydir()."lib/$lib/index.php";
			
			$libclass = "wfl_$lib";
			$_LIBS[$lib] = new $libclass();
		}
	
	}	

$project = loadproject($proj);
?>




<div id="proj_body">

<h2>ПРОЕКТ <?php  echo $proj; ?></h2>
<form method="post" id="proj_form">

<div id="pnl_left">
<table>
<?php 

foreach($project->params as $key => $param)
{
	echo "<tr>
		<th>".$param->title."</th>";
	echo "<td>";
	echo $project->draw_param_input($param);
	echo "</td>
	</tr>
	<tr><td colspan=\"2\">".$param->description."</td></tr>";
}
?>
<tr><td></td><td><input type="submit" name="subm_compile" value="Скомпилировать" /></td></tr>
</table>
</div>
<div id="pnl_right">
<h3>Сайт куда компилировать</h3>
<ul id="dst_site">
<?php 
$sites = scandir("./sites");
foreach ($sites as $site)
{
	if(($site!='..') && ($site!='.') && ($site!=$_SITE))
	{
	?>
	<li>
		<input type="radio" name="_SITE" value="<?php echo $site; ?>"/><label><?php echo $site; ?></label>
	</li>
	<?php
	} 
} 
?>
</ul>
</div>

</form>

</div>