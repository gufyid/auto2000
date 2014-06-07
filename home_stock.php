<table>
<tr>
<th>Input Stock</th>
</tr>
</table>
<form method="post" action="#">
<div id="boxy">
<div id="fieldset">
<div id="ki">
Tipe Produk</div>
<div div="ka">
<select name="tipe" id="tipe">
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$q=mysql_query("select * from t_produk order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">
Jumlah Stock
</div>
<div div="ka">
<input type="text" name="stok" id="stok">
</div>


<div>
<input type="submit" name="btx" value="Proses">
</div>
</div>
</div>
</form>

<?php
if(isset($_POST['btx'])){
$tipe=$_POST['tipe'];
$stok=$_POST['stok'];
$tgl=date("Y-m-d");
$user=$ARSESS[1];
myConn();
$cek=mysql_fetch_array(mysql_query("select 1 from t_stock where product='$_POST[tipe]'"));
if(mysql_affected_rows()>0){
$q="update t_stock set product='$tipe',
					   stock='$stok',
					   tgl='$tgl',
					   pelaksana='$user' where product='$tipe'";
mysql_query($q);
echo "<div id=\"okbox\">";
echo "Data Berhasil Diupdate";
echo "</div>";
echo "<meta http-equiv=refresh content=2;url=?c=stock>";
}else{
$q="insert into t_stock(product,stock,tgl,pelaksana)values('$tipe','$stok','$tgl','$user')";
mysql_query($q);
echo "<div id=\"okbox\">";
echo "Data Berhasil Disimpan";
echo "</div>";
//echo "$q";
//echo "<meta http-equiv=refresh content=2;url=logout.php>";
echo "<meta http-equiv=refresh content=2;url=?c=stock>";
}


/*
}else{
echo "<div id=\"errbox\">";
echo "Password Tidak Sama";
echo "</div>";
echo "<meta http-equiv=refresh content=2;url=?c=password>";
}
*/
}
?>
