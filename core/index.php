<?php 

$_BUFFER = '';

if(!empty($_GET['q']))
	$_QUERYSTR = $_GET['q'];
else
	$_QUERYSTR = substr($_SERVER["REQUEST_URI"],1);

function callback_endflush($buffer)
{
	// remplace toutes les pommes par des carottes
	GLOBAL $_QUERYSTR;
	GLOBAL $_BUFFER;
	$_BUFFER = $buffer;
	file_put_contents("./cache/".md5( session_id() .$_QUERYSTR), $buffer);
	//echo $buffer;
}

$cachefile = "./cache/".md5(session_id().$_QUERYSTR);

require_once './core/file/index.php';

$_SITE = "default";
$_ENTERPOINT = "frontend";
$_ARGS = Array();
$_PAGE = '';
$_ACTION = NULL;

define("TWODOT","@");
define("ACTIONPREFIX","!");


function parse_query()
{		
	//echo $querystr;
	//echo "REQUEST_URI = $querystr<br />";
	
	GLOBAL $_SITE;
	GLOBAL $_ARGS;
	GLOBAL $_PAGE;
	GLOBAL $_ENTERPOINT;
	GLOBAL $_ACTION;
	GLOBAL $_QUERYSTR;
	GLOBAL $delimeter_twdot;

	$querystr = $_QUERYSTR;
	
	$pos = strpos($querystr, TWODOT);
	
	
	$pos2 = strpos($querystr, '/');
	if(($pos2<$pos)&&($pos2>-1)) $pos = false;
	
	if ($pos === false)	// like arg1/arg2/arg3...
	{
		$_ARGS = explode('/',$querystr);
		
	}
	else 
	{					// like ep1:arg1...
		$_SITE = substr($querystr,0,$pos);
		$querystr = substr($querystr, $pos+1);
	//	$pos = strpos($querystr, TWODOT);
		$pos = strpos($querystr, '/');
		
		$pos2 = strpos($querystr, '/');
		if(($pos2<$pos)&&($pos2>-1)) $pos = false;
		
		if ($pos === false) 	// like site1:arg1/arg2...
		{
			$_ARGS = explode('/',$querystr);
	
			if(count($_ARGS)==1)
				$_ENTERPOINT =$querystr;
		}
		else		// like site1:ep1:arg1/arg2/arg3...
		{
			$_ENTERPOINT = substr($querystr,0,$pos);
			$querystr = substr($querystr, $pos+1);
			$_ARGS = explode('/',$querystr);
		}
	}
		
	foreach($_ARGS as $idx => $arg)
	{
		$arr = explode(':',$arg);
		if(count($arr)>1)
		{
			$_ARGS[$arr[0]] = $arr[1];
			unset($_ARGS[$idx]);
		}
	}
	
	// detect page
	$go = true;
	$path = "./sites/$_SITE/$_ENTERPOINT/pages";
	$idx = 0;
	
	if($_ARGS[0][0]==ACTIONPREFIX)
	{
		$_ACTION = true;
		$_ARGS[0] = substr($_ARGS[0],1);
	}
	
	while($go)
	{
		
		if(!empty($_ARGS[$idx]))
		{
			if(file_exists($path."/".$_ARGS[$idx]))
			{
				
				
				$path = $path."/".$_ARGS[$idx];
				$_PAGE = $_PAGE."/".$_ARGS[$idx];
				unset($_ARGS[$idx]);
				$idx++;
				
			}
			elseif(file_exists($path."/".$_ARGS[$idx].".php"))
			{
				
				
				$path = $path."/".$_ARGS[$idx];
				$_PAGE = $_PAGE."/".$_ARGS[$idx].".php";
				unset($_ARGS[$idx]);
				$idx++;
			}
			else 
				$go = false;
		}
		else 
			$go = false;
		
	}
	
	if(substr($_PAGE,-3)!='php') $_PAGE.="/index.php";
	
	$newargs = Array();
	foreach($_ARGS as $idx => $arg)
	{
		if(is_int($idx))
			$newargs[] = $arg;
		else
			$newargs[$idx] = $arg;
	}
	
	$_ARGS = $newargs;
	
	if($_ACTION==true)		
	{
		$_ACTION = $_PAGE;
		$_PAGE = "";
	}
	
}


// get the argument
function getarg($idx,$argname)
{
	GLOBAL $_ARGS;
	if(!empty($_ARGS[$argname])) return $_ARGS[$argname];
	elseif(!empty($_ARGS[$idx])) return $_ARGS[$idx];
	return null;
}
// get url
function geturl($params,$page="index",$site="default",$ep="frontend")
{
	$url = "";
	if(($site!="default")||($ep!="frontend"))
	{
		$url = "$site".TWODOT."$ep";
	}
	
	
	if($page!="index") $url .= "/$page";
	if($params==null) $params  = Array();
	foreach($params as $idx => $arg)
		{
			if(is_int($idx)) $url .= "/$arg";
		}
		
	foreach($params as $idx => $arg)
		{
			if(is_string($idx)) $url .= "/$idx:$arg";
		}
		
	
	return $url;
}
// get url
function nestedurl($css)
{
	GLOBAL $_SITE;
	GLOBAL $_ARGS;
	GLOBAL $_PAGE;
	GLOBAL $_ENTERPOINT;
	GLOBAL $_ACTION;
	
	
	return "/sites/$_SITE/$_ENTERPOINT/$css";
}

function getownurl($params,$page="index")
{
	GLOBAL $_SITE;
	GLOBAL $_ARGS;
	GLOBAL $_PAGE;
	GLOBAL $_ENTERPOINT;
	GLOBAL $_ACTION;
	
	$url = "";
	if(($_SITE!="default")||($_ENTERPOINT!="frontend"))
	{
		$url = "/$_SITE".TWODOT."$_ENTERPOINT";
	}
	//var_dump($url);
	
	if($page!="index") $url .= "/$page";
	if($params==null) $params  = Array();
	foreach($params as $idx => $arg)
	{
		if(is_int($idx)) $url .= "/$arg";
	}
	
	foreach($params as $idx => $arg)
	{
		if(is_string($idx)) $url .= "/$idx:$arg";
	}
	
	
	return $url;
	//return geturl($params,$page,$_SITE,$_ENTERPOINT);
}

function redirect($URL)
{
	?>
	<script type="text/javascript">
<!--
	document.location = "<?php echo $URL;?>";
//-->
</script>
	<?php 
//	header("Location:".$URL);
}

function makesite($sitename,$epoints = NULL)
{
	if(!file_exists("./sites/$sitename"))
		mkdir("./sites/$sitename");
	if($epoints==NULL)
	{
		$epoints = Array('frontend','backend');
	}
	foreach($epoints as $p)
	{
		mkdir("./sites/$sitename/$p");
		mkdir("./sites/$sitename/$p/pages");
		file_put_contents("./sites/$sitename/$p/pages/index.php", "<?php ?>");
	}
}

function sitedir()
{
	GLOBAL $_SITE;
	GLOBAL $_ARGS;
	GLOBAL $_PAGE;
	GLOBAL $_ENTERPOINT;
	return "./sites/$_SITE/";
}

function mydir()
{
	GLOBAL $_SITE;
	GLOBAL $_ARGS;
	GLOBAL $_PAGE;
	GLOBAL $_ENTERPOINT;
	return "./sites/$_SITE/$_ENTERPOINT/";
}
?>