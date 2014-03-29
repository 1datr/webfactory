<?php
session_start();

function getmicrotime(){
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}

$time_start = getmicrotime();

require_once './core/index.php';
parse_query();

if(!empty($_ARGS['urldebug']))
{
	echo "<div style=\"background:#000;color:#fff;width:100%;position:fixed;margin:0px;top:0px;\">SITE : $_SITE <br /> ENTERPOINT : $_ENTERPOINT <br /> PAGE : $_PAGE<br /> ACTION : $_ACTION<br /> ARGS : ";
	print_r($_ARGS);
	echo "</div>";
}

$_STOP_WORK = FALSE;
//echo "./sites/$_SITE/$_ENTERPOINT/pages$_PAGE";
if($_ACTION)
{
	if(!file_exists("./sites/$_SITE/$_ENTERPOINT/actions$_ACTION"))
	{
		if(file_exists("./sites/$_SITE/$_ENTERPOINT/404.php"))
			include "./sites/$_SITE/$_ENTERPOINT/404.php";
			else
				include "./core/404.php";
	}
	else
	{
		if(file_exists("./sites/$_SITE/config.php"))
				include "./sites/$_SITE/config.php";
				if(file_exists("./sites/$_SITE/$_ENTERPOINT/inc/index_action.php"))
						include "./sites/$_SITE/$_ENTERPOINT/inc/index_action.php";
				include "./sites/$_SITE/$_ENTERPOINT/actions$_ACTION";
		}
}
else 
{
	$_CACHE = true;
	// load page
	if(file_exists("./sites/$_SITE/config.php"))
		include "./sites/$_SITE/config.php";
	
	// caching
	if(file_exists($cachefile)&&(empty($_POST))&&($_CACHE))
	{
		echo file_get_contents($cachefile);
		$_STOP_WORK = true;
		
		
	}
	elseif(empty($_POST))	
		ob_start("callback_endflush");
	
	
	
	if(!$_STOP_WORK)
	{
		if(!file_exists("./sites/$_SITE/$_ENTERPOINT/pages$_PAGE"))
		{
			if(file_exists("./sites/$_SITE/$_ENTERPOINT/404.php"))
				include "./sites/$_SITE/$_ENTERPOINT/404.php";
			else 
				include "./core/404.php";
		}	
		else
		{			
			if(file_exists("./sites/$_SITE/$_ENTERPOINT/inc/index.php"))
				include "./sites/$_SITE/$_ENTERPOINT/inc/index.php";
			include "./sites/$_SITE/$_ENTERPOINT/pages$_PAGE";
		}
	
		// end flush
		if(empty($_POST))
			ob_end_flush();
		echo $_BUFFER;
		
		if(!empty($_POST))
			clear_cache();
	}
}


if(!empty($_ARGS['ptime']))
{
	$time_end = getmicrotime();
	$time = $time_end - $time_start;

	echo "<div style=\"background:#000;color:#fff;width:100%;position:fixed;bottom:8px;margin:0px;\">Did nothing in $time seconds</div>";
}
?>