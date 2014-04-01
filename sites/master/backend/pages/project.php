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

// save the project in file
if(!empty($_POST['subm_save']))
{
	foreach($_POST['params'] as $idx => $val)
	{
		$project->params[$idx]->value = $val;
	}	
	
	$project->save();
	redirect($_SERVER['HTTP_REFERER']);
}
// compile the project
if(!empty($_POST['subm_compile']))
{
	foreach($_POST['params'] as $idx => $val)
	{
		$project->params[$idx]->value = $val;
	}

	$project->save();
	redirect($_SERVER['HTTP_REFERER']);
}

?>


<div id="proj_body">

<h2>������ <?php  echo $proj; ?></h2>
<form method="post" id="proj_form">

<div>

<div class="section" id="pnl_left">

	<div id="tabs" class="htabs">
    <ul>
    <?php 
    $i = 0;
	foreach($_LIBS as $key => $lib)
	{ 
		?>
		<li><a href="#tabs-<?php echo $i;?>"><?php echo $lib->pagename; ?> </a></li>
	<?php 	
	$i++;
	}
?>       
    </ul>
    
    <?php 
    $i = 0;
	foreach($_LIBS as $key => $lib)
	{ 
		$pagelist = $lib->getpages();
		?>
		<div id="tabs-<?php echo $i;?>">
		<p>
		<?php 
		if(count($pagelist)==1)
		{
			$pagefun = "page_".$pagelist[0]['name'];
			$lib->$pagefun($project);
		}
		else 
		{
		?>
			<div id="tabs<?php echo $i;?>" class="vtabs">
			<ul class="ui-tabs-vertical">
			<?php 
			
			$j=0;
			foreach($pagelist as $page)
				{
				?>
					<li><a href="#tabs-<?php echo $i;?><?php echo $j;?>"><?php echo $page['title']; ?></a></li>
				<?php 
				$j++;
				}
			?>
			</ul>	
			<?php 
			$j=0;
			foreach($pagelist as $page)
				{
					$pagefun = "page_".$page['name'];
				?>
				<div id="tabs-<?php echo $i;?><?php echo $j;?>">
                    <p><?php $lib->$pagefun($project); ?></p>
                </div>				
				<?php 
				$j++;
				}
			?>
            </div>  
            <?php 
		}
            ?> 		
		</p>
		</div>		
		<?php 
		$i++;
	}
		?>    
	</div>


</div><!-- .section -->  
<?php 
/*
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
			<li><a href="javascript:" onclick="showpage('page_<?php echo $lib->getname(); ?>_<?php echo $page['name']; ?>');"><?php echo $page['title']; ?></a></li>
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
			<div id="page_<?php echo $lib->getname(); ?>_<?php echo $page['name']; ?>" class="libpage" <?php  echo $STYLE; ?>>
			<h3><?php echo $page['title']; ?></h3>
			<?php 
				$lib->$pagefun($project);
			?>
			</div>			
			<?php
			$i++; 
		}
		
}
?>
</div>
*/
?>

<div id="pnl_right">
<h3>���� ���� �������������</h3>
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
<input type="submit" name="subm_save" value="���������" />
<input type="submit" name="subm_compile" value="��������������" />
</div>
</form>

</div>