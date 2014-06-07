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

<script type="text/javascript">
function pilihanmu(){
	var val = 0;
	for( i = 0; i < document.form1.pilihan.length; i++ ){
		if( document.form1.pilihan[i].checked == true ){
			val = document.form1.pilihan[i].value;
			if(val=='1'){
				document.form1.salesman.disabled = false;	
				document.form1.kecamatan.disabled = true;	
				document.form1.tgl.disabled = false;
							
			}else if(val=='2'){
				document.form1.salesman.disabled = true;	
				document.form1.kecamatan.disabled = false;	
				document.form1.tgl.disabled = true;
			}else{
		document.form1.salesman.disabled = true;	
				document.form1.kecamatan.disabled = true;	
				document.form1.tgl.disabled = true;
			}
		}
	}
}
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
<td>Pilih Jenis Laporan
<input type="radio" name="pilihan" value="1" onClick='pilihanmu()'>By Salesman
<input type="radio" name="pilihan" value="2" onClick='pilihanmu()'>By Kecamatan
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Salesman</td><td><select class="small" name="salesman" id="salesman" disabled=""/>
<option value="all" selected="selected">Semua</option>
<?php
myConn();
$q=mysql_query("select * from t_salesman order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[kode]>$dtq[nama]</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>Kecamatan</td><td><select name="kecamatan" id="kecamatan" disabled="">
<option value="all" selected="selected">Semua</option>
<?php
myConn();
$q=mysql_query("select * from t_kecamatan order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>

</select>
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
if($_POST['pilihan']=="2"){

if($_POST['kecamatan']==""){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	
}else{
$bulan=array("01" => "Januari","02" => "Februari","03" => "Maret","04" => "April","05" => "Mei","06" => "Juni","07" => "Juli","08" => "Agustus","09" => "September","10" => "Oktober",
			"11" => "November","12" => "Desember");
				myconn();
if($ARSESS[0]=='1'){				
if($_POST['kecamatan']=='all'){
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
";
}else{
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where a.kecamatan='$_POST[kecamatan]'
";
}
}else{
if($_POST['kecamatan']=='all'){
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where d.spv='ARSESS[1]'
";
}else{
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where d.spv='ARSESS[1] and a.kecamatan='$_POST[kecamatan]'
";
}
}
$rq=mysql_query($q);	
$jum=mysql_num_rows($rq);
if($jum>0){			
$bln=$_POST['bln'];
echo "<center><h3>MONITORING COVERAGE AREA PER SALESMAN</h3></center>";
//echo "<center><h3>BULAN &nbsp;".strtoupper($bulan[$bln])."&nbsp;".strtoupper($_POST['thn'])	."</h3></center>";
echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_coverage_area.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";

echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Nama Usaha</th>";
echo "<th>Alamat</th>";
echo "<th>Contact Person</th>";
echo "<th>Kecamatan</th>";
echo "<th>Kota</th>";
echo "<th>Salesman</th>";
echo "<tr>";
$no=0;
while($dtq=mysql_fetch_array($rq)){
$no++;
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[nama_usaha]</td>";
echo "<td>$dtq[alamat]</td>";
echo "<td>$dtq[contact]</td>";
echo "<td>$dtq[kecamatan]</td>";
echo "<td>$dtq[kota]</td>";
echo "<td>$dtq[salesman]</td>";
echo "</tr>";
}
echo "</table>";	
//echo "window.open(\"includes/print_s_kelahiran.php?no=$_POST[no]\",\"\",\"width=1400,height=800,toolbar=0,scrollbars=1\")";
/*
echo "<input type=\"button\" name=\"print\" value=\"Print\" onclick=\"javascript:window.open('includes/print_laporan_pengeluaran_barang.php?bln=$_POST[bln]&thn=$_POST[thn]','','width=1400,height=800,toolbar=0,scrollbars=1')\">";
echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/laporan_pengeluaran.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";
echo "<input type=\"button\" name=\"excell\" value=\"Chart\" onclick=\"javascript:window.open('grafik/laporan_barang_keluar.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";
*/
//echo $q;			
}else{
echo "<div id=\"errbox\">";				
				echo "Data tidak ada...";		
				echo "</div>";
			echo "<p><a href=\"javascript: history.back()\">Back</a></p>";		
}
}//batas
}else{
if(($_POST['salesman']=="")){
		echo "<div id=\"errbox\">";		
		echo "You did not fill required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	
}else{
$bulan=array("01" => "Januari","02" => "Februari","03" => "Maret","04" => "April","05" => "Mei","06" => "Juni","07" => "Juli","08" => "Agustus","09" => "September","10" => "Oktober",
			"11" => "November","12" => "Desember");
				myconn();
				$tgl1=explode("/",$_POST['tgl']);
				$tgl_input=$tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
if($ARSESS[0]=='1'){				
if($_POST['salesman']=='all'){
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
";
}else{
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where a.salesman='$_POST[salesman]'
";
}
}else{
if($_POST['salesman']=='all'){
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where d.spv='ARSESS[1]'
";
}else{
$q="select a.nama as nama_usaha,a.alamat,a.contact,b.nama as kecamatan,c.nama as kota,d.nama as salesman from t_customer a
left join t_kecamatan b on b.id=a.kecamatan
left join t_kota c on c.id=b.kota
left join t_salesman d on d.kode=a.salesman
where d.spv='ARSESS[1] and a.salesman='$_POST[salesman]'
";
}
}

$rq=mysql_query($q);	
$jum=mysql_num_rows($rq);
if($jum>0){			
$bln=$_POST['bln'];
echo "<center><h3>MONITORING COVERAGE AREA PER SALESMAN</h3></center>";
//echo "<center><h3>BULAN &nbsp;".strtoupper($bulan[$bln])."&nbsp;".strtoupper($_POST['thn'])	."</h3></center>";
echo "<input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_coverage_area.php?bln=$_POST[bln]&thn=$_POST[thn]','width=1400,height=800,toolbar=0,scrollbars=1')\">";

echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Nama Usaha</th>";
echo "<th>Alamat</th>";
echo "<th>Contact Person</th>";
echo "<th>Kecamatan</th>";
echo "<th>Kota</th>";
echo "<th>Salesman</th>";
echo "<tr>";
$no=0;
while($dtq=mysql_fetch_array($rq)){
$no++;
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[nama_usaha]</td>";
echo "<td>$dtq[alamat]</td>";
echo "<td>$dtq[contact]</td>";
echo "<td>$dtq[kecamatan]</td>";
echo "<td>$dtq[kota]</td>";
echo "<td>$dtq[salesman]</td>";
echo "</tr>";
}
echo "</table>";	

}else{
echo "<div id=\"errbox\">";				
				echo "Data tidak ada...";			
				echo "</div>";
			echo "<p><a href=\"javascript: history.back()\">Back</a></p>";		
}
}//batas


}
echo "</div>";
}
?>
</body>
</html>