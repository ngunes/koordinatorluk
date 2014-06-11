<?php
function vtac(){
	$bag=mysqli_connect("localhost","root","1234","kor");
	if (mysqli_connect_errno()) {echo "Failed to connect to MySQL: " . mysqli_connect_error();}
	mysql_query("SET NAMES UTF8");
	return $bag;
}
function sorgu($sorgu){
	$bag=vtac();
  	$sonuc=mysqli_query($bag,$sorgu);
	mysqli_close($bag);
    return $sonuc;
} 

function idilekaydet($sorgu,$tablo,$alan){
    $bag=vtac();
  	$sonuc=mysqli_query($bag,$sorgu);
	$ids=mysqli_query($bag,"select max(".$alan.") As id from ".$tablo);
	$id=mysqli_fetch_assoc($ids);
	mysqli_close($bag);
	echo $id['id'];
	return $id['id'];
}

function teksorgu($sorgu){
    $bag=vtac();
  	$sonuc=mysqli_query($bag,$sorgu);
	if(mysqli_num_rows($sonuc))
		$kayit=mysqli_fetch_array($sonuc);
	else
		$kayit=NULL;
	mysqli_close($bag);
    return $kayit;
} 

function isletmelistesi(){
		echo "<form name=\"yeniisletme\" action=\"yeniisletme.php\" method=\"post\">";
		echo "Isletme Adi :<select name=\"isletme\" size=\"1\" onchange=\"this.form.submit()\">";
		echo "<option value=''>   </option>";
		echo "<option value=\"yeni\">Yeni Isletme</option>";
		$isletmeler=sorgu("Select * from  isletme order by isletmead");
	while($isl=mysqli_fetch_array($isletmeler)){
		echo "<option value='$isl[0]'>$isl[1]</option>";
		}		
		echo "</select>";
		echo "</form>";	
	}
function yaz($satir){
	echo $satir."<br />";
}
function yeniisletme(){
	yaz ("<form name=\"yeniisletme\" action=\"isletmekaydet.php\" method=\"post\">");
	yaz ("Isletme Adi :". "<input type=\"text\" name=\"isim\" />");
	yaz ("Telefon :"."<input type=\"text\" name=\"telefon\" />");
	yaz ("Fax :<input type=\"text\" name=\"fax\" />");
	yaz ("Adres :<input type=\"text\" name=\"adres\" />");
	yaz ("Staj Günü :<input type=\"text\" name=\"gun\">");
	yaz ("<input type=\"hidden\" name=\"iid\" value=\"-1\" \>");
	yaz("<input type=\"submit\" Value=\"kaydet\">");
	yaz ("</form>");
}

function isletmegetir($id,$m){
  	$isletme=teksorgu("select * from isletme where isletmeid=$id");
	yaz ("<form name=\"yeniisletme\" action=\"isletmekaydet.php\" method=\"post\">");
	yaz ("Isletme Adi :". "<input type=\"text\" name=\"isim\" value=$isletme[1] />");
	yaz ("Telefon :"."<input type=\"text\" name=\"telefon\" value=$isletme[2]  />");
	yaz ("Fax :<input type=\"text\" name=\"fax\" value=$isletme[3] />");
	yaz ("Adres :<input type=\"text\" name=\"adres\"  value=$isletme[4] />");
	yaz ("<input type=\"hidden\" name=\"iid\" value='$id' \>");
	yaz ("<input type=\"hidden\" name=\"mod\" value='$m' \>");
	yaz ("Staj Günü :<input type=\"text\" name=\"gun\">");
	yaz("<input type=\"submit\" Value=\"kaydet\">");
	yaz ("</form>");
}
function kontrol(){
  if (!isset($_SESSION["ogrid"])) header( 'Location: index.php' );
}

function ogrencilerigetir($iid){
		$ogrenciler=sorgu("SELECT oio.*,o.* FROM ogretmen_isletme_ogrenci AS oio INNER JOIN ogrenci AS o ON oio.ogrenciid=o.ogrid and oio.ogretmenisletmeid=$iid");
		while($ogrenci=mysqli_fetch_array($ogrenciler)){
			echo "<div class='ogrenci'>";
				yaz($ogrenci[2]."  ".$ogrenci[4]."  ".$ogrenci[5]);
			echo "</div>";	
		}
	}
function ogrform(){
	yaz("<pre>");
	yaz ("<form name=\"yeniogr\" action=\"ogrkaydet.php\" method=\"post\">");
	yaz ("Adı     :". "<input type=\"text\" name=\"isim\" />");
	yaz ("Soyadı  :<input type=\"text\" name=\"soyad\" />");
	yaz ("Okul No :<input type=\"text\" name=\"okulno\" />");
	yaz ("Alanı   :<input type=\"text\" name=\"alan\" />");
	yaz ("Dalı    :<input type=\"text\" name=\"dal\" />");
	yaz ("St. Günü:<input type=\"text\" name=\"gun\" />");
	yaz ("Cep Tel :<input type=\"text\" name=\"cep\" />");
	yaz ("E-Posta :<input type=\"text\" name=\"eposta\" />");
	yaz ("<input type=\"hidden\" name=\"iid\" value=".$_GET['isid']." />");
	yaz("<input type=\"submit\" Value=\"kaydet\">");
	yaz ("</form>");
	yaz("</pre>");
}
function isletmelerigetir($oid){
		$isletmeler=sorgu("Select oi.kayitid, I.* from ogretmen_isletme AS oi INNER JOIN isletme as I ON oi.isletmeid=I.isletmeid and oi.ogretmenid=$oid");
	while($isl=mysqli_fetch_array($isletmeler)){
		echo "<div class='isletme'>";
			echo "<form name='isletme' action='yeniisletme.php?mod=2' method='post'>";
			echo "<input type=\"hidden\" name=\"isletme\" value=$isl[1] />";
			echo "<h1 onclick=\"this.form.submit()\">".$isl[2]." ".$isl[3]."</h1>";
			echo "<input type=\"submit\" value=\"düzenle\" />";
			echo "<p> Tel :$isl[2]</p><p>Fax :$isl[3]</p><p>Adres :$isl[4]</p><p><a href=#> [ Rapor Yazdır ] </a></p>";
			echo "</form>";
		  	ogrencilerigetir($isl[0]);
			echo "<p><a href='ogrekle.php?isid=".$isl[0]."'>Öğrenci Ekle</a></p>";
		echo "</div>";
		}	
	}
?>
