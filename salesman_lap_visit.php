<?php
  header('Content-type: text/html; charset=utf-8');

/**
 * @author gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
getLevelThreeTitle($ACL2ID,$_GET['action']);
echo "<h3>$LV2TITLE | $LV3TITLE</h3>";


?>
<link rel="stylesheet" href="./styles/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script type="text/javascript" src="./libs/livevalidation.js"></script>
<script src="./libs/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="./libs/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<script type="text/javascript" src="./ajax/ajax_audit.js"></script>
<script type="text/javascript" charset="utf-8">
	jQuery(function($){
	$("#tgl1").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	$("#tgl2").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
});
	//
	//
</script>
<style type="text/css"/>
table, td{
	font:100% Arial, Helvetica, sans-serif; 
}
table{width:100%;border-collapse:collapse;margin:1em 0;}
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
<script type="text/javascript">
function pilihanmu(){
	var val = 0;
	for( i = 0; i < document.form1.pilihan.length; i++ ){
		if( document.form1.pilihan[i].checked == true ){
			val = document.form1.pilihan[i].value;
			if(val=='1'){
				document.form1.tgl1.disabled = false;	
				document.form1.tgl2.disabled = false;	
				document.form1.customer.disabled = true;
				document.form1.sevenstep.disabled= true;
							
			}else if(val=='2'){
				document.form1.tgl1.disabled = true;	
				document.form1.tgl2.disabled = true;	
				document.form1.customer.disabled = false;
				document.form1.sevenstep.disabled= true;
			}else if(val=='3'){
				document.form1.tgl1.disabled = true;	
				document.form1.tgl2.disabled = true;	
				document.form1.customer.disabled = true;
				document.form1.sevenstep.disabled= false;
				
			}
		}
	}
}
</script>

 


<div id="boxy">
<?php
$x=$_GET['x'];
$id=$_GET['id'];
$thn=date("Y");
if(!empty($id)){
$view="";
$view.="<form method=\"post\" action=\"#\">";
$view.="<table>";
$view.="<th>Input Komentar Visit Salesman</th>";
$view.="</table>";
$view.="<div id=ki>Komentar</div>";
$view.="<div id=ka><input type=text name=komentar id=komentar></div>";
$view.="<input type=submit name=btx1 value=Proses>";
$view.="</form>";
echo $view;
if(isset($_POST['btx1'])){
myConn();
$dino=date("Y-m-d");
$q="update t_kunjungan set komentar='$_POST[komentar]' where id='$id'";
mysql_query($q);
$masuk="insert into t_komentar(id_kunjungan,tgl_komentar,komentar)values('$id','$dino','$_POST[komentar]')";
mysql_query($masuk);
				echo "<div id=\"okbox\">";		
				echo "Komentar berhasil disimpan";		
				echo "</div>";

echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=lap&action=visit>";				
}
}else{
?>
<form name="form1" method="post" action="#">
<div id="boxy" >
<fieldset>
<form method="post" action="#">
<table>
<th>Laporan Visit Salesman</th>
</table>
<div id="ki2">Pilih Jenis Laporan
<input type="radio" name="pilihan" id="pilihan" value="1" onClick='pilihanmu()'>By Tanggal
<input type="radio" name="pilihan" id="pilihan" value="2" onClick='pilihanmu()'>By Customer
<input type="radio" name="pilihan" id="pilihan" value="3" onClick='pilihanmu()'>By Activity/7step
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Tanggal</div>
<div id="ka"><input type="hidden" name="hx" value="<?php echo $x;?>"><input type="text" class="small" name="tgl1" id="tgl1" readonly="readonly" disabled="disabled"/>&nbsp;&nbsp;&nbsp;s/d&nbsp;&nbsp;&nbsp;<input type="text" class="small" name="tgl2" id="tgl2" readonly="readonly" disabled="disabled"/></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Customer</div>
<div id="ka"><select name="customer" id="customer" disabled="disabled">
<option value="" selected="selected">Pilih</option>
<?php
myconn();
if($ARSESS[0]=='1'){
$q=mysql_query("select * from t_customer");
}elseif($ARSESS[8]=='4'){
$q=mysql_query("select * from t_customer where salesman='$ARSESS[1]'");
}elseif($ARSESS[8]=='3'){
$q=mysql_query("select a.kode,a.nama from t_customer a 
				left join t_salesman b on b.kode=a.salesman where b.spv='$ARSESS[1]'");
}
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[kode]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">7step</div>
<div id="ka"><select name="sevenstep" id="sevenstep" disabled="disabled">
<option value="" selected="selected">Pilih</option>
<?php
myConn();
$q=mysql_query("select * from t_sevenstep order by id");
while($dtq=mysql_fetch_array($q)){
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>
<input type="reset" value="Reset"/>&nbsp;<input type="submit" name="btx" value="Proses"/>
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
if((!empty($_POST['tgl1'])) && (!empty($_POST['tgl2']))){
$tgl1=explode("/",$_POST['tgl1']);
$tgl1=$tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
$tgl2=explode("/",$_POST['tgl2']);
$tgl2=$tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
if($ARSESS[0]=='1'){
$q="select * from t_kunjungan where tgl between '$tgl1' and '$tgl2'";
}elseif($ARSESS[8]=='4'){
$q="select * from t_kunjungan where tgl between '$tgl1' and '$tgl2' and salesman='$ARSESS[1]'";
}elseif($ARSESS[8]=='3'){
$q="select a.id,a.tgl,a.customer,a.keterangan,a.komentar,a.sevenstep from t_kunjungan a
	left join t_salesman b on b.kode=a.salesman
	where a.tgl between '$tgl1' and '$tgl2' and b.spv='$ARSESS[1]'";
}

$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_visit.php?tgl1=$tgl1&tgl2=$tgl2&user=$ARSESS[0]&salesman=$ARSESS[1]&status=$ARSESS[8]')\"></div>";
}elseif(!empty($_POST['customer'])){
$q="select * from t_kunjungan where customer='$_POST[customer]'";
$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_visit.php?cust=$_POST[customer]&user=$ARSESS[0]')\"></div>";
}else{
if($ARSESS[0]=='1'){
$q="select a.id,a.tgl,a.customer,a.keterangan,a.sevenstep from t_kunjungan a
left join t_customer b on b.kode=a.customer
where a.sevenstep='$_POST[sevenstep]'";
}elseif($ARSESS[8]=='4'){
$q="select a.id,a.tgl,a.customer,a.keterangan,a.sevenstep from t_kunjungan a
left join t_customer b on b.kode=a.customer
where a.sevenstep='$_POST[sevenstep]' and a.salesman='$ARSESS[1]'";
}elseif($ARSESS[8]=='3'){
$q="select a.id,a.tgl,a.customer,a.keterangan,a.komentar,a.sevenstep from t_kunjungan a
left join t_customer b on b.kode=a.customer
left join t_salesman c on c.kode=a.salesman
where a.sevenstep='$_POST[sevenstep]' and c.spv='$ARSESS[1]'";

}

$excell.="<div align=right><input type=\"button\" name=\"excell\" value=\"To Excell\" onclick=\"javascript:window.open('eksport/lap_visit.php?sevenstep=$_POST[sevenstep]&user=$ARSESS[0]&salesman=$ARSESS[1]&status=$ARSESS[8]')\"></div>";
}

$rq=mysql_query($q);
$jum=mysql_num_rows($rq);
//echo $q;
//echo $ARSESS[8];
//echo $ARSESS[8];
echo $excell;
$view="";
$view.="<table border=1 id=tabelku>";
$view.="<thead>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Salesman</th>";
$view.="<th>Customer</th>";
$view.="<th>Tanggal</th>";
$view.="<th>7Step</th>";
$view.="<th>Deal/Loss</th>";
$view.="<th>Alasan Loss</th>";
$view.="<th>DEC</th>";
$view.="<th>CR1</th>";
$view.="<th>CR2</th>";
$view.="<th>CR3</th>";
$view.="<th>Keterangan</th>";
$view.="<th>Komentar</th>";
$view.="</tr>";
$view.="</thead>";
$view.="<tbody>";
while($dt=mysql_fetch_array($rq)){
$no++;
$service=mysql_fetch_array(mysql_query("select * from t_after_sales where id_kunjungan='$dt[id]'"));
$cust=mysql_fetch_array(mysql_query("select * from t_customer where kode='$dt[customer]'"));
$step=mysql_fetch_array(mysql_query("select * from t_sevenstep where id='$dt[sevenstep]'"));
$loss=mysql_fetch_array(mysql_query("select * from t_loss where id='$dt[status_loss]'"));

$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$cust[salesman]</td>";
$view.="<td>$cust[nama]</td>";
$view.="<td>".date("d-M-Y",strtotime($dt['tgl']))."</td>";
$view.="<td>$step[nama]</td>";
if($dt['deal_loss']=='D'){
$view.="<td>Deal</td>";
}elseif($dt['deal_loss']=='L'){
$view.="<td>Loss</td>";
}else{
$view.="<td></td>";
}
$view.="<td>$loss[nama]</td>";
$view.="<td>$service[del]</td>";
$view.="<td>$service[cr1]</td>";
$view.="<td>$service[cr2]</td>";
$view.="<td>$service[cr3]</td>";
$view.="<td>$dt[keterangan]</td>";
if(($ARSESS[8]=='3') && ($dt['komentar']=="")){
$view.="<td><a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=visit&amp;id=$dt[id]&x=0\">Komentar</a></td>";
}elseif(($ARSESS[0]=='1') || ($ARSESS[8]=='4')){
$view.="<td><font color=red>$dt[komentar]</font></td>";
}else{
$view.="<td>$dt[komentar]</td>";
}
}
$view.="</tbody>";
$view.="</table>";
if($jum>0){
echo $view;
}else{
echo "<div id=\"errbox\">";		
				echo "No Data...";		
				echo "</div>";
//echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=lap&action=visit>";				
}
}
}
echo "</div>";
}
?>
