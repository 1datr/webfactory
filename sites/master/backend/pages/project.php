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
//var_dump($_POST);

if(!empty($_POST['subm_save']))
{
	$keys = array_keys($_POST['params']);
	//var_dump($keys);
	foreach($keys as $idx)
	{
		//var_dump($idx);
		if(is_array($_POST['params'][$idx]))
		{
			foreach($_POST['params'][$idx] as $idx2 => $v)
			{
				if($v=="")
					unset($_POST['params'][$idx][$idx2]);
			}
		}
		$project->params[$idx]->value = $_POST['params'][$idx];
	}
	
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
	$keys = array_keys($_POST['params']);
	//var_dump($keys);
	foreach($keys as $idx)
	{
		//var_dump($idx);
		if(is_array($_POST['params'][$idx]))
		{
			foreach($_POST['params'][$idx] as $idx2 => $v)
			{
				if($v=="")
					unset($_POST['params'][$idx][$idx2]);
			}
		}
		$project->params[$idx]->value = $_POST['params'][$idx];
	}
	
	
	$project->save();
	//var_dump($project->params["enterpoints"]);
	if($_POST['_SITE']=='&newsite')
	{
		$_POST['_SITE']=$_POST['newsitename'];
	}
	//print_r($_POST);
	$project->compile($_POST['_SITE']);
	redirect($_SERVER['HTTP_REFERER']);
}

?>


<h2>ПРОЕКТ <?php  echo $proj; ?></h2>
<form method="post" id="proj_form" enctype="multipart/form-data">

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
	<li><input type="radio" name="_SITE" value="<?php echo $site; ?>" <?php echo $checked; ?>/><label><?php echo $site; ?></label></li>
	<?php
	$i++;
	} 
} 
?>
<li><input type="radio" name="_SITE" value="&newsite"/><label>Новый сайт</label><br />
<input type="text" name="newsitename" value=""/>
</li>
</ul>
</div>

</div>

<div>
<input type="submit" name="subm_save" value="Сохранить" />
<input type="submit" name="subm_compile" value="Скомпилировать" />
</div>
</form>

