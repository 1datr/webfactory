<?php 


function head($title)
{
	GLOBAL $_ARGS;
	?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" version="XHTML+RDFa 1.0" dir="ltr">
	<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-type" content="text/html; charset=cp1251"/>
			
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/style.css");?>" media="all" />
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/jquery-ui.css");?>" media="all" />
	
	<script src="<?php echo nestedurl("js/jquery.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("js/jquery-ui.min.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("js/lib.js");?>" type="text/javascript"></script>

	<script type="text/javascript">
	
	</script>
	
	</head>
			<body>
			
				<div id="header">
					<div id="header_nested">
						
					</div>
				</div>
<?php 
$menu_array = Array(
	"Выход"=>getownurl(null,"exit"),
	"Проекты"=>getownurl(null),
	"Модули"=>getownurl(null,"modules"),
);				
?>
				<div id="menu">
				<ul>
				<?php 
				if(!empty($_SESSION['authed']))
				foreach($menu_array as $capt => $ref)
				{
					?>
					<li><a href="<?php echo $ref;?>"><?php echo $capt;?></a></li>
					<?php 
				}
				?>
				</ul>
				</div>
				
				<div id="proj_body">
<?php 
}


if(empty($_SESSION['authed'])&&($_PAGE!='/auth.php'))
{
	//echo geturl(null,"auth",$_SITE,$_ENTERPOINT);
	print_r($_SERVER);
	$_SESSION['REDIRECT_URL'] = $_SERVER['REDIRECT_URL'];
	redirect(getownurl(null,"auth"));
}
?>
</div>