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
<script type="text/javascript">
function pilihanmu(){
	var val = 0;
	for( i = 0; i < document.form1.pilihan.length; i++ ){
		if( document.form1.pilihan[i].checked == true ){
			val = document.form1.pilihan[i].value;
			if(val=='1'){
				document.form1.jenis_usaha.disabled = false;	
				document.form1.kendaraan.disabled = true;	
				document.form1.kecamatan.disabled = true;
							
			}else if(val=='2'){
				document.form1.jenis_usaha.disabled = true;	
				document.form1.kendaraan.disabled = false;	
				document.form1.kecamatan.disabled = true;
				
			}else if(val=='3'){
				document.form1.jenis_usaha.disabled = true;	
				document.form1.kendaraan.disabled = true;	
				document.form1.kecamatan.disabled = false;
				
			}
		}
	}
}
</script>

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

	
?>
<div id="boxy" >
<fieldset>
<?php
$thn=date("Y");
?>
<form name="form1" method="post" action="#">
<table>
<th>Laporan Data Customer</th>
</table>
<div id="ki2">Pilih Jenis Laporan
<input type="radio" name="pilihan" id="pilihan" value="1" onClick='pilihanmu()'>By Jenis Usaha
<input type="radio" name="pilihan" id="pilihan" value="2" onClick='pilihanmu()'>By Tipe Kendaraan
<input type="radio" name="pilihan" id="pilihan" value="3" onClick='pilihanmu()'>By Kecamatan
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Jenis Usaha</div>
<div id="ka"><select name="jenis_usaha" id="jenis_usaha" disabled="disabled">
<option value="all">Semua</option>
<?php
myConn();
$q=mysql_query("select * from t_jenis_usaha order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Tipe Kendaraan</div>
<div id="ka"><select name="kendaraan" id="kendaraan" disabled="disabled">
<option value="all">Semua</option>
<?php
myConn();
$q=mysql_query("select * from t_produk order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Kecamatan</div>
<div id="ka"><select name="kecamatan" id="kecamatan" disabled="disabled">
<option value="all">Semua</option>
<?php
myConn();
if($ARSESS[0]=='1'){
$q=mysql_query("select distinct(a.kecamatan),b.nama from t_customer a
				left join t_kecamatan b on b.id=a.kecamatan 
				where b.nama is not null
				order by b.nama");
}elseif($ARSESS[8]=='3'){
$q=mysql_query("select distinct(a.kecamatan),b.nama from t_customer a
				left join t_kecamatan b on b.id=a.kecamatan 
				left join t_salesman c on c.kode=a.salesman
				where b.nama is not null and c.spv='$ARSESS[1]'
				order by b.nama");
}elseif($ARSESS[8]=='4'){
$q=mysql_query("select distinct(a.kecamatan),b.nama from t_customer a
				left join t_kecamatan b on b.id=a.kecamatan 
				where b.nama is not null and a.salesman='$ARSESS[1]'
				order by b.nama");
}

while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[kecamatan]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>


<input type="reset" value="Reset"/>&nbsp;<input type="submit" name="btx" value="Proses"/>
<div id="divider"></div>
</fieldset>
</form>


<?php
if(isset($_POST['btx'])){
if(empty($_POST['pilihan'])){
		echo "<div id=\"errbox\">";		
		echo "Pilih salah satu filter laporan!!!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {

	myconn();
	$excell="";

if(!empty($_POST['jenis_usaha']))
{
$bulan=array("01" => "Januari","02" => "Februari","03" => "Maret","04" => "April","05" => "Mei","06" => "Juni","07" => "Juli","08" => "Agustus","09" => "September","10" => "Oktober",
			"11" => "November","12" => "Desember");
if($_POST['jenis_usaha']=='all'){
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where b.spv='$ARSESS[1]'";
//$q="select * from t_customer where jenis_usaha='$_POST[jenis_usaha]'";
}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where a.salesman='$ARSESS[1]'";
}

}else{
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a
where a.jenis_usaha='$_POST[jenis_usaha]'";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where a.jenis_usaha='$_POST[jenis_usaha]' and b.spv='$ARSESS[1]'";
//$q="select * from t_customer where jenis_usaha='$_POST[jenis_usaha]'";
}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where a.jenis_usaha='$_POST[jenis_usaha]' and a.salesman='$ARSESS[1]'";
}
}

$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/data_customer.php?jenis_usaha=$_POST[jenis_usaha]&user=$ARSESS[0]&status=$ARSESS[8]&man=$ARSESS[1]')\"></div>";

}elseif(!empty($_POST['kendaraan'])){
if($_POST['kendaraan']=='all'){
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where b.spv='$ARSESS[1]'";
//$q="select * from t_customer where jenis_usaha='$_POST[jenis_usaha]'";
}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where a.salesman='$ARSESS[1]'";
}
}else{
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a
where a.tipe='$_POST[kendaraan]'";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where a.tipe='$_POST[kendaraan]' and b.spv='$ARSESS[1]'";
//$q="select * from t_customer where jenis_usaha='$_POST[jenis_usaha]'";
}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where a.tipe='$_POST[kendaraan]' and a.salesman='$ARSESS[1]'";
}
}
$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/data_customer.php?kendaraan=$_POST[kendaraan]&user=$ARSESS[0]&status=$ARSESS[8]&man=$ARSESS[1]')\"></div>";


}elseif(!empty($_POST['kecamatan'])){
if($_POST['kecamatan']=='all'){
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where b.spv='$ARSESS[1]'";

}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where and a.salesman='$ARSESS[1]'";
}
}else{
if($ARSESS[0]=='1'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha from t_customer a
where a.kecamatan='$_POST[kecamatan]'";
}elseif($ARSESS[8]=='3'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
left join t_salesman b on b.kode=a.salesman
where a.kecamatan='$_POST[kecamatan]' and b.spv='$ARSESS[1]'";

}elseif($ARSESS[8]=='4'){
$q="select a.kode,a.nama,a.alamat,a.contact,a.kecamatan,a.telp,a.jenis_usaha,a.jasa_produksi,
a.prospect_first_cust,a.decision,a.jenis_badan_usaha,a.omzet,a.lama_usaha,a.lokasi_usaha,a.salesman from t_customer a
where a.kecamatan='$_POST[kecamatan]' and a.salesman='$ARSESS[1]'";
}
}
$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/data_customer.php?kecamatan=$_POST[kecamatan]&user=$ARSESS[0]&status=$ARSESS[8]&man=$ARSESS[1]')\"></div>";

}

$busaha=mysql_fetch_array(mysql_query("select nama from t_jenis_usaha where id='$_POST[jenis_usaha]'"));

$rq=mysql_query($q);	
$jum=mysql_num_rows($rq);
if($jum>0){		
//echo $q;	
$bln=$_POST['bln'];
echo "<center><h3>LAPORAN DATA CUSTOMER</h3></center>";
echo "<center><h3>PER JENIS USAHA&nbsp;".strtoupper($busaha['nama'])."</h3></center>";
//include "grafik/grafik_data_customer.php";
//echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/data_customer.php?busaha=$_POST[jenis_usaha]&admin=$ARSESS[0]&user=$ARSESS[8]&kode=$ARSESS[1]','width=1400,height=800,toolbar=0,scrollbars=1')\">";
echo $excell;
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
$badanusaha=mysql_fetch_array(mysql_query("select * from t_badan_usaha where id='$dtq[jenis_badan_usaha]'"));$omzet=mysql_fetch_array(mysql_query("select * from t_omzet where id='$dtq[omzet]'"));
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
//echo "<td>".number_format($dtq['omzet'])."</td>";
echo "<td>$omzet[keterangan]</td>";
echo "<td>$dtq[lama_usaha]</td>";
echo "<td>$dtq[lokasi_usaha]</td>";
echo "</tr>";
}
echo "</table>";	

}else{
echo "<div id=\"errbox\">";				
				echo "Data tidak ada...";		
				echo "</div>";
//			echo "<p><a href=\"javascript: history.back()\">Back</a></p>";		
//var_dump($q);
}


}
} //akhir if
echo "</div>";

?>
</body>
</html>