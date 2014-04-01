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
	
	<script src="<?php echo nestedurl("js/jquery.js");?>" type="text/javascript"></script>
	<script src="<?php echo nestedurl("js/jquery.treeview.js");?>" type="text/javascript"></script>

	<script type="text/javascript">

		function showpage(pageid)
		{
			$(".libpage").hide();
			$("#"+pageid).show();
		}
	
		$(function() {
			$(".treeview").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
	</script>
	
	</head>
			<body>
				<div id="header">
					<div id="header_nested">
	
					</div>
				</div>
<?php 

}


if(empty($_SESSION['authed'])&&($_PAGE!='/auth.php'))
{
	//echo geturl(null,"auth",$_SITE,$_ENTERPOINT);
	redirect("/".geturl(null,"auth",$_SITE,$_ENTERPOINT));
}
?>