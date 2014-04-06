<?php 


function head($title)
{
	GLOBAL $_ARGS;
	?>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" version="XHTML+RDFa 1.0" dir="ltr">
	<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-type" content="text/html; charset=cp1251"/>
			
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/bootstrap.css");?>" media="all" />
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/bootstrap-responsive.css");?>" media="all" />
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/style.css");?>" media="all" />
	
	<script src="<?php echo nestedurl("js/jquery.min.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("js/bootstrap/bootstrap.min.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("js/lib.js");?>" type="text/javascript"></script>

	<script type="text/javascript">
	
	</script>
	
	</head>
			<body>
						
				<div class="container">
					<div class="row" id="header">
						<div id="header_nested">
						
						</div>
					</div>
				
<?php 
/*
 
 <script src="<?php echo nestedurl("bootstrap/js/bootstrap-tabs.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("bootstrap/js/watch.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("bootstrap/js/widgets.js");?>" type="text/javascript"></script>
	
 
 * 
 * <script src="<?php echo nestedurl("bootstrap/js/bootstrap-tabs.js");?>" type="text/javascript"></script>
 * 
 	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("css/jquery-ui.css");?>" media="all" />	
 	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("bootstrap/css/bootstrap-theme.min.css");?>" media="all" />
	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("bootstrap/css/bootstrap-responsive.min.css");?>" media="all" />	
 	<link type="text/css" rel="stylesheet" href="<?php echo nestedurl("bootstrap/css/bootstrap-responsive.min.css");?>" media="all" />
 	
 	<script src="<?php echo nestedurl("bstabs/js/bootstrap.min.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("bstabs/js/customtabs.js");?>" type="text/javascript"></script>
	

  
 * */
$menu_array = Array(
	"Выход"=>getownurl(null,"exit"),
	"Проекты"=>getownurl(null),
	"Модули"=>getownurl(null,"modules"),
);				
?>
				<div class="navbar">
				<div class="container">
				<ul class="nav nav-tabs">
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
				</div>
				
				
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
