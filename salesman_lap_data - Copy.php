<html>
<head><title></title>
<script src="./libs/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="./styles/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<link rel="stylesheet" href="./styles/colorbox.css" />
<script type="text/javascript" src="./libs/livevalidation.js"></script>
<script src="./libs/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<script src="./libs/jquery.colorbox.js" type="text/javascript" charset="utf-8"></script>	

<script type="text/javascript" charset="utf-8">
	jQuery(function($){
	$("#tgl").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	//
	});
	//
</script>

<style type="text/css"/>
table, td{
	font:100% Arial, Helvetica, sans-serif; 
}
table{width:100%;border-collapse:collapse;margin:1em 0;}
td{text-align:left;padding:.5em;border:1px solid #fff;}
th{text-align:center;padding:.5em;border:1px solid #fff;}
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
<?php

/**
 * @author gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
getLevelThreeTitle($ACL2ID,$_GET['action']);
echo "<h3>$LV2TITLE | $LV3TITLE</h3>";

if(!isset($_POST['btx'])){
	
?>
<div id="boxy" >
<?php
$thn=date("Y");
?>
<form name="form1" method="post" action="#">
<table width="100%" border="0">
<tr>
<td>Bidang Usaha</td><td><select name="bidang_usaha" id="bidang_usaha">
<option value="" selected="selected">Pilih</option>
<option value="all">Semua</option>
<?php
myConn();
$q=mysql_query("select * from t_bidang_usaha order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>
</td>
</td>
</tr>

</table>
<input type="reset" value="Reset"/>&nbsp;<input type="submit" name="btx" value="Proses"/>
<div id="divider"></div>
</fieldset>
</form>


<?php
}else{

if(($_POST['bidang_usaha']=="")){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	
}else{
$bulan=array("01" => "Januari","02" => "Februari","03" => "Maret","04" => "April","05" => "Mei","06" => "Juni","07" => "Juli","08" => "Agustus","09" => "September","10" => "Oktober",
			"11" => "November","12" => "Desember");
				myconn();
if($ARSESS[0]=='1'){
if($_POST['bidang_usaha']=='all'){
$q="select * from t_customer";
}else{
$q="select * from t_customer where bidang_usaha='$_POST[bidang_usaha]'";
}
}elseif($ARSESS[8]=='4'){				
if($_POST['bidang_usaha']=='all'){
$q="select * from t_customer where  salesman='$ARSESS[1]'";
}else{
$q="select * from t_customer where bidang_usaha='$_POST[bidang_usaha]' and salesman='$ARSESS[1]'";
}
}elseif($ARSESS[8]=='3'){				
if($_POST['bidang_usaha']=='all'){
$q="select * from t_customer a
	left join t_supervisor b on b.kode=a.spv";
}else{
$q="select * from t_customer a
	left join t_supervisor b on b.kode=a.spv where bidang_usaha='$_POST[bidang_usaha]'";
}
}
$busaha=mysql_fetch_array(mysql_query("select nama from t_bidang_usaha where id='$_POST[bidang_usaha]'"));

$rq=mysql_query($q);	
$jum=mysql_num_rows($rq);
if($jum>0){			
$bln=$_POST['bln'];
echo "<center><h3>LAPORAN DATA CUSTOMER</h3></center>";
echo "<center><h3>PER BIDANG USAHA&nbsp;".strtoupper($busaha['nama'])."</h3></center>";
include "grafik/grafik_data_customer.php";
echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/data_customer.php?busaha=$_POST[bidang_usaha]&admin=$ARSESS[0]&user=$ARSESS[8]&kode=$ARSESS[1]','width=1400,height=800,toolbar=0,scrollbars=1')\">";
/*
echo "<table>";
echo "<tr>";
echo "<th>NO</th>";
echo "<th>Nama Usaha</th>";
echo "<th>Alamat</th>";
echo "<th>Contact Person</th>";
echo "<th>Telp</th>";
echo "<th>Kecamatan</th>";
echo "<th>Kota</th>";
echo "<th>Jenis Usaha</th>";
echo "<th>Jasa/Produksi</th>";
echo "<th>Prospect/First/Cust</th>";
echo "<th>Decision Maker</th>";
echo "<th>Jenis Badan Usaha</th>";
echo "<th>Omzet</th>";
echo "<th>Lama Usaha</th>";
echo "<th>Lokasi Usaha</th>";
echo "<tr>";
$no=0;
while($dtq=mysql_fetch_array($rq)){
$no++;
$kecamatan=mysql_fetch_array(mysql_query("select a.nama as kecamatan,b.nama as kota from t_kecamatan a
left join t_kota b on a.kota=b.id where a.id='$dtq[kecamatan]'"));
$jusaha=mysql_fetch_array(mysql_query("select nama from t_jenis_usaha where id='$dtq[jenis_usaha]'"));
$badanusaha=mysql_fetch_array(mysql_query("select * from t_badan_usaha where id='$dtq[jenis_badan_usaha]'"));

echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[nama]</td>";
echo "<td>$dtq[alamat]</td>";
echo "<td>$dtq[contact]</td>";
echo "<td>$dtq[telp]</td>";
echo "<td>$kecamatan[kecamatan]</td>";
echo "<td>$kecamatan[kota]</td>";
echo "<td>$jusaha[nama]</td>";
if($dtq['jasa_produksi']=='J'){
echo "<td>Jasa</td>";
}else{
echo "<td>Produksi</td>";
}
if($dtq['prospect_first_cust']=="P"){
echo "<td>Prospect</td>";
}elseif($dtq['prospect_first_cust']=="F"){
echo "<td>First</td>";
}else{
echo "<td>Cust</td>";
}
if($dtq['decision']=='1'){
echo "<td>Owner</td>";
}else{
echo "<td>Purchasing</td>";
}
echo "<td>$badanusaha[nama]</td>";
echo "<td>".number_format($dtq['omzet'])."</td>";
echo "<td>$dtq[lama_usaha]</td>";
echo "<td>$dtq[lokasi_usaha]</td>";
echo "</tr>";
}
echo "</table>";	
*/
echo "<p><a href=\"javascript: history.back()\"><<< Kembali</a></p>";		

//echo "window.open(\"includes/print_s_kelahiran.php?no=$_POST[no]\",\"\",\"width=1400,height=800,toolbar=0,scrollbars=1\")";

//echo "<input type=\"button\" name=\"print\" value=\"Print\" onclick=\"javascript:window.open('includes/print_laporan_pengeluaran_barang.php?bln=$_POST[bln]&thn=$_POST[thn]','','width=1400,height=800,toolbar=0,scrollbars=1')\">";
//echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/laporan_pengeluaran.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";
//echo "<input type=\"button\" name=\"excell\" value=\"Chart\" onclick=\"javascript:window.open('grafik/laporan_barang_keluar.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";

//echo $q;			
}else{
echo "<div id=\"errbox\">";				
				echo "Data tidak ada...";		
				echo "</div>";
			echo "<p><a href=\"javascript: history.back()\">Back</a></p>";		
}
}

}
echo "</div>";

?>
</body>
</html>