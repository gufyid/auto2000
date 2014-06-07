<div id="container">
<h2>Ganti Password</h2>
<form method="post" action="#">
<div>
Masukkan Password baru anda
</div>
<div>
<input type="password" id="pwd1" name="pwd1">
</div>


<div>
Masukkan Kembali Password baru anda
</div>
<div>
<input type="password" id="pwd2" name="pwd2">
</div>

<div>
<input type="submit" name="btx" value="Proses">
</div>
</form>
</div>
<?php
if(isset($_POST['btx'])){
$pwd1=md5($_POST['pwd1']);
$pwd2=md5($_POST['pwd2']);

if($pwd1==$pwd2){
myConn();
$q="update user set usr_passwd='$pwd1' where usr_uname='$ARSESS[1]'";
mysql_query($q);
echo "<div id=\"okbox\">";
echo "Password Berhasil Diupdate";
echo "</div>";
echo "<meta http-equiv=refresh content=2;url=logout.php>";

}else{
echo "<div id=\"errbox\">";
echo "Password Tidak Sama";
echo "</div>";
echo "<meta http-equiv=refresh content=2;url=?c=password>";

}
}
?>
