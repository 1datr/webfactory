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
<h2>опнейр <?php  echo $proj; ?></h2>
<?php 
print_r($project);
?>