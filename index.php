<?php 
require_once './core/index.php';
parse_query();

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
	if(!file_exists("./sites/$_SITE/$_ENTERPOINT/pages$_PAGE"))
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
		if(file_exists("./sites/$_SITE/$_ENTERPOINT/inc/index.php"))
			include "./sites/$_SITE/$_ENTERPOINT/inc/index.php";
		include "./sites/$_SITE/$_ENTERPOINT/pages$_PAGE";
	}
}
?>