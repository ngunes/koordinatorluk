<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h1> Yeni İşletme Kayıt Sayfası</h1>
<?php 
	session_start();
	include 'fonksiyonlar.php';
	
	kontrol();
	$ogr=$_SESSION['ogrid'];
	if(!isset($_POST["isletme"])) {isletmelistesi();}
	elseif($_POST["isletme"]=="yeni"){yeniisletme();}
	else{isletmegetir($_POST["isletme"]);}
?>

</body>
</html>