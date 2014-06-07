<script type="text/javascript" src="./libs/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<table>
<tr>
<th>Input Berita/News</th>
</tr>
</table>
<form method="post" action="#">
<div id="boxy">
<div id="fieldset">
<div id="ki">
Judul Berita</div>
<div div="ka">
<input type="text" name="judul" id="judul">
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>

<div div="ki">
Isi Berita1
</div>
<div div="ka">
<textarea name="isi_berita" id="isi_berita" style="width: 70%;"></textarea>
</div>

<div>
<input type="submit" name="btx" value="Proses">
</div>
</div>
</div>
</form>

<?php
if(isset($_POST['btx'])){
$judul=$_POST['judul'];
$berita=$_POST['isi_berita'];
$tgl=date("Y-m-d");
$user=$ARSESS[1];
myConn();
$q="insert into t_news(judul,isi,tgl,pelaksana)values('$judul','$berita','$tgl','$user')";
mysql_query($q);
echo "<div id=\"okbox\">";
echo "Data Berhasil Disimpan";
echo "</div>";
echo "<meta http-equiv=refresh content=2;url=?c=news>";

}


?>
