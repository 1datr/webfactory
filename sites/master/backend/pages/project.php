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



addcss("css/bootstrap.css");
addcss("css/bootstrap-responsive.css");
addcss("css/style.css");

addscript("js/bootstrap/bootstrap.min.js");
addscript("js/lib.js");



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


//set_include_path(mydir()."phpbootstrap/");
use BootstrapPHP\BootstrapPHP;


include mydir().'BootstrapPHP/BootstrapPHP.php';

BootstrapPHP::register_autoload();

use BootstrapPHP\Tabs;
?>


<div class="row">
	<div class="page-header">
	 
	<h1>ПРОЕКТ <?php  echo $proj; ?></h1>
	</div>
</div>


<form method="post" enctype="multipart/form-data">


<div class="row">
	<div class="span10">
	
	
	<?
	$tabs_libs = new Tabs();
	//var_dump($tabs_libs);
	$tabs_libs->setDirection(Tabs::DIRECTION_LEFT);	
	
	
	$i=0;
	foreach($_LIBS as $key => $lib)
	{
		$pagelist = $lib->getpages();
		if(count($pagelist)==1)
		{
			$pagefun = "page_".$pagelist[0]['name'];
			
			ob_start();
			$lib->$pagefun($project);
			$var = ob_get_contents();
			ob_end_clean();
			if($i==0)
				$tabs_libs->addContentItem($lib->pagename, "page_".$key, $var, false, true);
			else 
				$tabs_libs->addContentItem($lib->pagename, "page_".$key, $var, false);
			
		}
		else
		{
			$tabs_pages = new Tabs();
			$tabs_pages->setDirection(Tabs::DIRECTION_DEFAULT);
			$j=0;
			foreach($pagelist as $pidx => $page)
				{
					$pagefun = "page_".$page['name'];
					
					ob_start();
					$pagefun = "page_".$page['name'];	
					$lib->$pagefun($project); 
					$var = ob_get_contents();
					ob_end_clean();
					
					if($j==0)
						$tabs_pages->addContentItem($page['title'], "page_".$key."_".$pidx, $var, false, true);
					else
						$tabs_pages->addContentItem($page['title'], "page_".$key."_".$pidx, $var, false);				
				$j++;
				}
			
			if($i==0)
				$tabs_libs->addContentItem($lib->pagename, "page_".$key, $tabs_pages->toHtml(), false, true);
			else
				$tabs_libs->addContentItem($lib->pagename, "page_".$key, $tabs_pages->toHtml(), false);
		}
		$i++;
	}
	echo $tabs_libs->toHtml();
?>
	</div>

	<div class="span2">
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
			<li>
				
					<input type="radio" name="_SITE" value="&newsite" /><label>Новый сайт</label><br />
					<input type="text" name="newsitename" value=""  />
				
			</li>
		</ul>
	</div>
</div>
    

	
<div class="row">
	<div class="btn-group">
		<input type="submit" name="subm_save" value="Сохранить" class="btn" />
		<input type="submit" name="subm_compile" value="Скомпилировать" class="btn" />
	</div>

	
</div>

</form>
</div>	
