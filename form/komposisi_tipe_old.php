<html>
<head>
<title></title>
<style>
table, td{
	font:90% Arial, Helvetica, sans-serif; 
}
table{width:100%;border-collapse:collapse;margin:1em 0;}
th{text-align:center;padding:.5em;border:1px solid #fff;}
th, td{text-align:left;padding:.5em;border:1px solid #fff;}
th{background:#328aa4 url(../images/tr_back.gif) repeat-x;color:#fff;}
td{background:#e5f1f4;}

/* tablecloth styles */

tr.even td{background:#e5f1f4;}
tr.odd td{background:#f8fbfc;}

th.over, tr.even th.over, tr.odd th.over{background:#4a98af;}
th.down, tr.even th.down, tr.odd th.down{background:#bce774;}
th.selected, tr.even th.selected, tr.odd th.selected{}

td.over, tr.even td.over, tr.odd td.over{background:#ecfbd4;}
td.down, tr.even td.down, tr.odd td.down{background:#bce774;color:#fff;}
td.selected, tr.even td.selected, tr.odd td.selected{background:#bce774;color:#555;}

/* use this if you want to apply different styleing to empty table cells*/
td.empty, tr.odd td.empty, tr.even td.empty{background:#fff;}
</style>
</head>
<body>
<div id="tabs-6">
<div id="tabs_komposisi">
<ul>
<li><a href="#tabs_komposisi">Data Per Salesman</a></li>
</ul>
<div id="tabs_komposisi">


<form method="post" action="#">
<div><label>Salesman</label>&nbsp;&nbsp;<select name="salesman" id="salesman">
<option value="" selected="selected">Pilih</option>
<option value="all">Semua</option>
<?php
myconn();
if($ARSESS[0]==1){
$q=mysql_query("select * from t_salesman");
}else{
$q=mysql_query("select * from t_salesman where spv='$ARSESS[1]'");
}
while($dtq=mysql_fetch_array($q)){
?>
<option value="<?php echo $dtq['kode'];?>"><?php echo $dtq['nama'];?></option>";
<?php
}
?>
</select>
<input type="submit" name="btx" value="Proses">
</form>
</div>

<?php if(isset($_POST['btx'])){ //Jika tombol proses di tekan 
if($ARSESS[0]==1){
if($_POST['salesman']=='all'){
$q=mysql_query("select * from t_kunjungan order by salesman");
}else{
$q=mysql_query("select * from t_kunjungan where salesman='$_POST[salesman]' order by salesman");
}
}else{
if($_POST['salesman']=='all'){
$q=mysql_query("select * from t_kunjungan order by salesman");
}else{
$q=mysql_query("select * from t_kunjungan a
				left join t_salesman b on b.kode=a.salesman where a.salesman='$_POST[salesman]' and b.spv='$ARSESS[1]' order by a.salesman");
}
}
$jum=mysql_num_rows($q);
$view="";
$view.="<table>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Salesman</th>";
$view.="<th>Tanggal</th>";
$view.="<th>7step</th>";
$view.="<th>Deal/Loss</th>";
$view.="<th>Status Loss</th>";
$view.="<th>DEC</th>";
$view.="<th>CR1</th>";
$view.="<th>CR2</th>";
$view.="<th>CR3</th>";
$view.="<th>20.000 KM</th>";
$view.="<th>30.000 KM</th>";
$view.="<th>40.000 KM</th>";
$view.="<th>50.000 KM</th>";
$view.="<th>Keterangan</th>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$visit=mysql_fetch_array(mysql_query("select * from t_after_sales where id_kunjungan='$dtq[id]'"));
$salesman=mysql_fetch_array(mysql_query("select * from t_salesman where kode='$dtq[salesman]'"));
$step=mysql_fetch_array(mysql_query("select * from t_sevenstep where id='$dtq[sevenstep]'"));
$loss=mysql_fetch_array(mysql_query("select * from t_loss where id='$dtq[status_loss]'"));

$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$salesman[nama]</td>";
$view.="<td>".date("d-m-Y",strtotime($dtq['tgl']))."</td>";
$view.="<td>$step[nama]</td>";
if($dtq['deal_loss']=='D'){
$view.="<td>Deal</td>";
}elseif($dtq['deal_loss']=='L'){
$view.="<td>Loss</td>";
}else{
$view.="<td></td>";
}
$view.="<td>$loss[nama]</td>";
$view.="<td>$visit[del]</td>";
$view.="<td>$visit[cr1]</td>";
$view.="<td>$visit[cr2]</td>";
$view.="<td>$visit[cr3]</td>";
$view.="<td>$visit[dua_puluh]</td>";
$view.="<td>$visit[tiga_puluh]</td>";
$view.="<td>$visit[empat_puluh]</td>";
$view.="<td>$visit[lima_puluh]</td>";
$view.="<td>$dtq[keterangan]</td>";

$view.="</tr>";
}
$view.="</tr>";
$view.="</table>";
if($jum>0){
echo "<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_aktivitas_sales.php?salesman=$_POST[salesman]&user=$ARSESS[0]&spv=$ARSESS[1]')\"> </div>";
echo "<center><h2>Data Visit/Kunjungan Salesman</h2></center>";
echo $view;
}else{
				echo "<center><font color=red><h4>Tidak ada data</h4></font></center>";		
				echo "<meta http-equiv=refresh content=2;url=?c=spv&sub=lap&action=act>";

}
}
?>
</div>

</div> <!--akhir div tabs2 -->
</div>
</body>
</html>
