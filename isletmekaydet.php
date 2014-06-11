<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koordinatörlük</title>
</head>

<body>
<?php 
	session_start();
	include 'fonksiyonlar.php';
	
	kontrol();
	$ogr=$_SESSION['ogrid'];
	$iid=$_POST['iid'];
	$iad=$_POST['isim'];
	$itel=$_POST['telefon'];
	$ifax=$_POST['fax'];
	$iadres=$_POST['adres'];
	$igun=$_POST["gun"];

	if($iid==-1)
	{
		$iid=idilekaydet("insert into isletme (isletmead,tel,fax,adres) values('$iad','$itel','$ifax','$iadres')","isletme","isletmeid");
		echo "yeni kayıt id : ".$iid;
	}
	if ($iid>0)
	{
			if($_POST["mod"]==1)
			
		$s=sorgu("insert into ogretmen_isletme(isletmeid,ogretmenid,stajgun,aciklama) values('$iid','$ogr','$igun','Açıklama yok')");
		if($_POST["mod"]==2){
		$s=sorgu("update isletme set isletmead='$iad',tel='$itel',fax='$ifax',adres='$iadres' where isletmeid=$iid");
		$o=sorgu("update ogretmen_isletme stajgun=$igun where ogretmenid=$ogr and isletmeid=$iad");
		}
		header( 'Location: anasayfa.php' ) ;
	}
	
?>
</body>
</html>