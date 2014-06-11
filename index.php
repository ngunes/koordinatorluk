<?php include 'bas.inc';
		session_start();
		include 'fonksiyonlar.php';
		?>
<form name="giris" action="giris.php" method="post">
<pre>
Kullanıcı adı : <input type="text" name="isim" />
Şifre         : <input type="password" name="sifre" />
<input type="submit" value="Giriş Yap" /> <input type="reset" value="İptal"  /> 

</form>
</body>
</html>