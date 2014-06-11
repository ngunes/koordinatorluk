<?php include 'bas.inc';
		session_start();
		include 'fonksiyonlar.php';
	
		kontrol();
		$ogr=$_SESSION['ogrid']; 
		$sonuc=teksorgu("select * from ogretmen where ogretmenid=$ogr");
		echo "<div id=\"ogretmen\"><h1>".$sonuc[2]." ".$sonuc[3]."</h1></div>";	
		isletmelerigetir($ogr);
	?>
    <div id="isletmeekle" style="text-align:right"><a href="yeniisletme.php?mod=1">Yeni İşletme Ekle</a></div>
</div>
Iı Ğğ Üü Şş İi Öö Çç
</body>
</html>