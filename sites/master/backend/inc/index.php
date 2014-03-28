<?php 
session_start();

foreach($LIBS as $lib)
{
	if(file_exists(sitedir()."/lib/$lib/index.php"))
		require_once sitedir()."/lib/$lib/index.php";

}

function head($title)
{
	GLOBAL $_ARGS;
	?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" version="XHTML+RDFa 1.0" dir="ltr">
	<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-type" content="text/html; charset=cp1251"/>
			<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/style.css");?>" media="all" />
			</head>
			<body>
				<div id="header">
					<div id="header_nested">
	
					</div>
				</div>
<?php 
	if(!empty($_ARGS['urldebug']))
	{
		echo "<div style=\"background:#000;color:#fff;width:100%;position:fixed;margin:0px;top:0px;\">SITE : $_SITE <br /> ENTERPOINT : $_ENTERPOINT <br /> PAGE : $_PAGE<br /> ACTION : $_ACTION<br /> ARGS : ";
		print_r($_ARGS);
		echo "</div>";
	}
}


if(empty($_SESSION['authed'])&&($_PAGE!='/auth.php'))
{
	//echo geturl(null,"auth",$_SITE,$_ENTERPOINT);
	redirect("/".geturl(null,"auth",$_SITE,$_ENTERPOINT));
}
?>