<?php 
$proj = getarg(0, 'proj');
head($proj);
$wfapi_files = scandir(mydir()."/inc/wfapi");
foreach($wfapi_files as $file)
	if($file!='.'&& $file!='..')
	require_once mydir()."/inc/wfapi/".$file;

$project = loadproject($proj);
?>
<h2>опнейр <?php  echo $proj; ?></h2>