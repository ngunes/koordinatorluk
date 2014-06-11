<?php 
	session_start();
	include 'fonksiyonlar.php';
	kontrol();
	$ogretmen=$_SESSION['ogrid'];
	$oiid=$_POST['iid'];
	$oad=$_POST['isim'];
	$osoyad=$_POST['soyad'];
	$ookulno=$_POST['okulno'];
	$oalan=$_POST['alan'];
	$odal=$_POST['dal'];
	$ogun=$_POST['gun'];
	$ocep=$_POST['cep'];
	$oeposta=$_POST['eposta'];
	$oid=idilekaydet("insert into ogrenci (ad,soyad,okulno,alan,dal,stajgunleri,ceptel,eposta) values('$oad','$osoyad',$ookulno,'$oalan','$odal',$ogun,'$ocep','$oeposta')","ogrenci","ogrid");
	echo "öğrenci id :".$oid;
	echo "<br /> öğretmen işletme id :".$oiid;
	$s=sorgu("insert into ogretmen_isletme_ogrenci (ogretmenisletmeid,ogrenciid) values ($oiid,$oid)");
	header( 'Location: anasayfa.php' ) ;
	
	
?>