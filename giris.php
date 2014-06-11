<?php
session_start();
include 'fonksiyonlar.php';
	$ad=$_POST["isim"];
	$sifre=$_POST["sifre"];
	
	$kayit=teksorgu("select * from ogretmen where kad='$ad' and sifre='$sifre'");
	if($kayit){
	 		$_SESSION["ogrid"]=$kayit["ogretmenid"];
			header( 'Location: anasayfa.php' );

		}
	else header( 'Location: index.php' ) ;
?>