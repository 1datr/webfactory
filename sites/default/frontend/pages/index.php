<?php
echo getarg(0,'x');
?>

<a href="<?=geturl(Array(7,8))?>">ref1</a>
<?php 
///makesite("master");

try {
	# MS SQL Server � Sybase ����� PDO_DBLIB

	# MySQL ����� PDO_MYSQL
	$DBH = new PDO("mysql:host=localhost;dbname=syskit","root", "");

	$STH = $DBH->query('SELECT * from skccache_views');
	
	# ������������� ����� �������
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	while($row = $STH->fetch()) 
	{
		foreach($row as $key => $val)
			echo "$key : $val<br />";
		echo "<br />";
	}
}
catch(PDOException $e) {
echo $e->getMessage();
	}
?>