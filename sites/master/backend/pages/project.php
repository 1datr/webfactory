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

<div>

<div id="pnl_left">

<ul class="treeview" id="tree">
<?php 
foreach($_LIBS as $key => $lib)
{ 
	?>
	<li><?php echo $lib->pagename; ?>
		<ul>
		<?php 
		foreach($lib->getpages() as $page)
		{
			?>
			<li><?php echo $page['title']; ?></li>
			<?php 
		}
		?>
		</ul>
	</li>
	<?php 	
}
?>
</ul>
</div>

<div id="pnl_page">
<?php 
$i=0;
foreach($_LIBS as $key => $lib)
{ 
	
		foreach($lib->getpages() as $page)
		{
			$pagefun = "page_".$page['name'];
			if($i==0)
				$STYLE = '';
			else 
				$STYLE = "style=\"display:none;\"";
			?>
			<div id="page_<?php echo $lib->getname(); ?>_<?php echo $page; ?>" class="libpage" <?php  echo $STYLE; ?>>
			<h3><?php echo $page['title']; ?></h3>
			<?php 
				$lib->$pagefun();
			?>
			</div>			
			<?php
			$i++; 
		}
		
}
?>
</div>


<div id="pnl_right">
<h3>Сайт куда компилировать</h3>
<ul id="dst_site">
<?php 
$sites = scandir("./sites");
$i=0;
foreach ($sites as $site)
{
	if(($site!='..') && ($site!='.') && ($site!=$_SITE))
	{
		if($i==0) $checked = "checked"; else $checked = "";
	?>
	<li>
		<input type="radio" name="_SITE" value="<?php echo $site; ?>" <?php echo $checked; ?>/><label><?php echo $site; ?></label>
	</li>
	<?php
	$i++;
	} 
} 
?>
</ul>
</div>

</div>

<div>
<input type="submit" name="subm_save" value="Сохранить" />
<input type="submit" name="subm_compile" value="Скомпилировать" />
</div>
</form>

</div>