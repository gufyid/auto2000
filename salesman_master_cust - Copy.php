<?php

/**
 * @author gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
getLevelThreeTitle($ACL2ID,$_GET['action']);
echo "<h3>$LV2TITLE | $LV3TITLE</h3>";
if($_GET['x']=="2"){
include "customer_detail.php";
}else{

if(!isset($_POST['btx'])){
myConn();
$cek=mysql_fetch_array(mysql_query("select max(urut) as kode from t_customer where left(kode,2)='$ARSESS[1]'"));
if($cek['kode']==""){
$kode=$ARSESS[1]."0001";
$urut=1;
}else{
if(strlen($cek['kode'])=='1'){
$urut="000";
$urut.=$cek['kode']+1;
}elseif(strlen($cek['kode'])=='2'){
$urut="00";
$urut.=$cek['kode']+1;
}elseif(strlen($cek['kode'])=='3'){
$urut="0";
$urut.=$cek['kode']+1;
}else{
$urut=$cek['kode']+1;
}
$kode=$ARSESS[1]."".$urut;
}
if($ARSESS[0]=='1'){
$quv = mysql_query("SELECT * FROM t_customer ORDER BY id ASC") or die(mysql_error());
}else{
$quv = mysql_query("SELECT * FROM t_customer where left(kode,2)='$ARSESS[1]' ORDER BY id ASC") or die(mysql_error());
}
$jum_vendor=mysql_num_rows($quv);
mysql_close();
$nuv = mysql_numrows($quv);
if($_GET['x']=="0"){
myconn();
$data=mysql_fetch_array(mysql_query("select * from t_customer where kode='$_GET[eid]'"));
$tgl=explode("-",$data['tgl_lahir']);
$tgl_lahir=$tgl[2]."/".$tgl[1]."/".$tgl[0];
$kode=$data['kode'];
$urut=$data['urut'];
}elseif($_GET['x']=="1"){
myConn();
$quv = mysql_query("delete from t_customer where kode='$_GET[eid]'") or die(mysql_error());
				//echo "<div id=\"okbox\">";		
				//echo "Data berhasil dihapus";		
				//echo "</div>";
echo "<script type=\"text/javascript\">";
echo "alert('Data berhasil dihapus!!!')";
echo "</script>";				

//include ('./includes/del_satuan.php');
$quv = mysql_query("SELECT * FROM t_customer ORDER BY id ASC") or die(mysql_error());
mysql_close();
$nuv = mysql_numrows($quv);
//$_GET['x']=="3";
//				echo "<meta http-equiv=\"refresh\" content=\"1;URL=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=satuan\"\">";
echo "Anda dalam mode disable, untuk input <b>Jenis</b> baru anda harus klik <a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=cust\"\"><b>Disini</b></a>";
}
?>
<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script> 
</script> 
<link rel="stylesheet" href="./styles/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />

<script type="text/javascript" src="./libs/livevalidation.js"></script>
<script src="./libs/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="./libs/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<script type="text/javascript" src="./ajax/ajax_kota.js"></script>
<script type="text/javascript" charset="utf-8">
	jQuery(function($){
	$("#tgl_lahir").datepicker(
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
<div id="boxy" >
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
<td>Kode</td>
<td><input type="text" name="kode" id="kode" size="25" value="<?php echo $kode;?>" readonly="readonly"/><input type="hidden" name="kodeh" value="<?php echo $urut;?>"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<hr />
<table width="100%" border="0">
<tr>
<td>Nama Usaha</td>
<td><input type="text" name="nama_usaha" id="nama_usaha" size="50" value="<?php echo $data[nama];?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Alamat</td>
<td><textarea name="alamat" id="alamat" cols="30" rows="5"><?php echo $data['alamat'];?></textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Contact Person</td>
<td><input type="text" name="contact" id="contact" cols="30" rows="10" value="<?php echo $data['contact'];?>"></textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>No Telepon</td>
<td><input type="text" name="telp" id="telp" size="50" value="<?php echo $data[telp];?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Kota - Kecamatan</td>
<td><select name="kota" id="kota" onchange='process_kota()'/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$kota=mysql_query("select * from t_kota order by id");
while($dtkota=mysql_fetch_array($kota)){
if($dtkota['id']==$data['kota']){
echo "<option value=$dtkota[id] selected=\"selected\">$dtkota[nama]</option>";
}else{
echo "<option value=$dtkota[id]>$dtkota[nama]</option>";
}
}
?>
</select>&nbsp;&nbsp;<label id="kecamatanku"></label>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Tempat Lahir</td>
<td><input type="text" name="tempat_lahir" id="tempat_lahir" size="30" value="<?php echo $data[tempat_lahir];?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Tgl Lahir</td>
<td><input type="text" name="tgl_lahir" id="tgl_lahir" readonly="readonly" value="<?php echo $tgl_lahir;?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Jenis Usaha</td>
<td><select name="jenis_usaha" id="jenis_usaha"/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$jusaha=mysql_query("select * from t_jenis_usaha order by id");
while($dtjusaha=mysql_fetch_array($jusaha)){
if($dtjusaha['id']==$data['jenis_usaha']){
echo "<option value=$dtjusaha[id] selected=\"selected\">$dtjusaha[nama]</option>";
}else{
echo "<option value=$dtjusaha[id]>$dtjusaha[nama]</option>";
}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Jasa / Produksi</td>
<td><select name="jasa_produksi" id="jasa_produksi"/>
<?php
if($data['jasa_produksi']=="J"){
echo "<option value=\"J\" selected=\"selected\">Jasa</option>";
echo "<option value=\"P\">Produksi</option>";
}elseif($data['jasa_produksi']=="P"){
echo "<option value=\"J\">Jasa</option>";
echo "<option value=\"P\" selected=\"selected\">Produksi</option>";
}else{
echo "<option value=\"\" selected=\"selected\">Pilih</option>";
echo "<option value=\"J\">Jasa</option>";
echo "<option value=\"P\">Produksi</option>";
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Prospect/First/Cust</td>
<td><select name="prospect_first_cust" id="prospect_first_cust"/>
<?php
if($data['prospect_first_cust']=='P'){
echo "<option value=\"P\" selected=\"selected\">Prospect</option>";
echo "<option value=\"F\">First</option>";
echo "<option value=\"C\">Cust</option>";
}elseif($data['prospect_first_cust']=='F'){
echo "<option value=\"P\">Prospect</option>";
echo "<option value=\"F\" selected=\"selected\">First</option>";
echo "<option value=\"C\">Cust</option>";
}elseif($data['prospect_first_cust']=='C'){
echo "<option value=\"P\">Prospect</option>";
echo "<option value=\"F\">First</option>";
echo "<option value=\"C\" selected=\"selected\">Cust</option>";
}else{
echo "<option value=\"\" selected=\"selected\">Pilih</option>";
echo "<option value=\"P\">Prospect</option>";
echo "<option value=\"F\">First</option>";
echo "<option value=\"C\">Cust</option>";
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Tipe</td>
<td><select name="tipe" id="tipe"/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$tipe=mysql_query("select * from t_produk order by id");
while($dttipe=mysql_fetch_array($tipe)){
if($dttipe['id']==$data['tipe']){
echo "<option value=$dttipe[id] selected=\"selected\">$dttipe[nama]</option>";
}else{
echo "<option value=$dttipe[id]>$dttipe[nama]</option>";
}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>UIO</td>
<td><select name="uio" id="uio"/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$uio=mysql_query("select * from t_uio order by id");
while($dtuio=mysql_fetch_array($uio)){
if($dtuio['id']==$data['uio']){
echo "<option value=$dtuio[id] selected=\"selected\">$dtuio[nama]</option>";
}else{
echo "<option value=$dtuio[id]>$dtuio[nama]</option>";
}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Decision Maker</td>
<td><select name="decision" id="decision"/>
<?php
if($data['decision']=='1'){
echo "<option value=\"1\" selected=\"selected\">Owner</option>";
echo "<option value=\"2\">Purchasing</option>";
}elseif($data['decision']=='2'){
echo "<option value=\"1\">Owner</option>";
echo "<option value=\"2\" selected=\"selected\">Purchasing</option>";
}else{
echo "<option value=\"\" selected=\"selected\">Pilih</option>";
echo "<option value=\"1\">Owner</option>";
echo "<option value=\"2\">Purchasing</option>";
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Jenis Badan Usaha</td>
<td><select name="jenis_badan_usaha" id="jenis_badan_usaha"/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
$jbusaha=mysql_query("select * from t_badan_usaha order by id");
while($dtjbusaha=mysql_fetch_array($jbusaha)){
if($dtjbusaha['id']==$data['jenis_badan_usaha']){
echo "<option value=$dtjbusaha[id] selected=\"selected\">$dtjbusaha[nama]</option>";
}else{
echo "<option value=$dtjbusaha[id]>$dtjbusaha[nama]</option>";
}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Omzet</td>
<td><select name="omzet" id="omzet" />
<option value="" selected="selected">Pilih</option>
<?php
myConn();
$q=mysql_query("select * from t_omzet order by id");
while($dtq=mysql_fetch_array($q)){
if($data['omzet']==$dtq['id']){
echo "<option value=$dtq[id] selected=\"selected\">$dtq[keterangan]</option>";
}else{
echo "<option value=$dtq[id]>$dtq[keterangan]</option>";
}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Lama Usaha</td>
<td><select name="lama_usaha" id="lama_usaha" />
<option value="" selected="selected">Pilih</option>
<?php
myConn();
$q=mysql_query("select * from t_lama_usaha order by id");
while($dtq=mysql_fetch_array($q)){
if($data['lama_usaha']==$dtq['id']){
echo "<option value=$dtq[id] selected=\"selected\">$dtq[keterangan]</option>";
}else{
echo "<option value=$dtq[id]>$dtq[keterangan]</option>";
}
}
?>
</select>

</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Lokasi Usaha</td>
<td><input type="text" name="lokasi_usaha" id="lokasi_usaha" size="50" value="<?php echo $data[lokasi_usaha];?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Networking</td>
<td><input type="text" name="networking" id="networking" size="20" value="<?php echo $data[networking];?>"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Foto</td>
<td><input type="file" name="foto" id="foto"/>&nbsp;Jpeg Only</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>


</table>
<hr />
<input type="submit" name="btx" value="Tambah"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>
<table cellspacing="0" cellpadding="0">			
	<tr>				
		<th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Contact</th>
		<th>Tools</th>
	</tr>
<?php
   for($iuv=0;$iuv<$nuv;$iuv++){
   	  $auv = mysql_fetch_array($quv);
   	 // getMyOfficeCode($auv['office_id']);
   	 // getMyOfficeBranch($auv['office_id']);
      //
   	  $view = "<tr>";
	  $view.= "<td width=\"40\">";
	  $view.= number_format($iuv + 1);
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= $auv['kode'];
	  $view.= "</td>";	
	  $view.= "<td>";
	  $view.= ucwords($auv['nama']);
	  $view.= "</td>"; 
	  $view.= "<td>";
	  $view.= ucwords($auv['alamat']);
	  $view.= "</td>";  
	  $view.= "<td>";
	  $view.= ucwords($auv['contact']);
	  $view.= "</td>";  

	  $view.= "<td width=\"40\">";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=cust&amp;eid=$auv[kode]&x=0\">";
	  $view.= "edit";
	  $view.= "</a>&nbsp;&nbsp;";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=cust&amp;eid=$auv[kode]&x=1\">";
	  $view.= "delete";
	  $view.= "</a>&nbsp;&nbsp;";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=cust&amp;eid=$auv[kode]&x=2\">";
	  $view.= "detail";
	  $view.= "</a>";
	  $view.= "</td>";
   	  $view.= "</tr>";
   	  //
   	  echo $view;
   }
?>	

</table>

<?php
}else{
if(empty($_POST['kode'])||empty($_POST['nama_usaha'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
	
	if($_POST['uio']=='1'){
	$uio=1;
	$segmen=1;
	}elseif($_POST['uio']=='2'){
	$uio=2;
	$segmen=2;
	}elseif($_POST['uio']=='3'){
	$uio=3;
	$segmen=2;
	}elseif($_POST['uio']=='4'){
	$uio=4;
	$segmen=3;

	}
	
	if($_POST['omzet']=='1'){
	$omzet=1;
	}elseif($_POST['omzet']=='2'){
	$omzet=2;
	}elseif($_POST['omzet']=='3'){
	$omzet=3;
	}elseif($_POST['omzet']=='4'){
	$omzet=4;
	}
	
	if($_POST['lama_usaha']=='1'){
	$lama=1;
	}elseif($_POST['lama_usaha']=='2'){
	$lama=2;
	}elseif($_POST['lama_usaha']=='3'){
	$lama=3;
	}elseif($_POST['lama_usaha']=='4'){
	$lama=4;
	}
myconn();
	$kec=mysql_fetch_array(mysql_query("select a.nama,b.status from t_kecamatan a
										left join t_kota b on b.id=a.kota where a.id='$_POST[kecamatan]'"));
	if($kec['status']=='black'){
	$area=1;
	}elseif($kec['status']=='red'){
	$area=2;
	}elseif($kec['status']=='yellow'){
	$area=3;
	}elseif($kec['status']=='green'){
	$area=4;
	}
	
	$x=$uio + $omzet + $lama + $area;
	if($x<=8){
	$score="RED";
	}elseif($x<=12){
	$score="YELLOW";
	}elseif($x<=16){
	$score="GREEN";
	}

	if($_POST['tgl_lahir']==''){
	$tgl="0000-00-00";
	}else{
	$tgl=explode("/",$_POST['tgl_lahir']);
	$tgl=$tgl[2]."-".$tgl[1]."-".$tgl[0];
	 }
	 $acak=rand(000,999);
     $foto=str_replace(' ','',$_FILES['foto']['name']);
     $size=$_FILES['foto']['size'];
     $asal=$_FILES['foto']['tmp_name'];
     $tipe=$_FILES['foto']['type'];
     $sizek=$size/1000;
     $foto1=$_POST['kode'].$_POST['nama'].$acak.$foto;
	if(($_GET['x']!="0"))
	{
	if($foto){ //jika ada foto yang di upload
	if($tipe=="image/jpeg"){
    UploadImagecustomer($foto1,$size,$asal);
				//// good to go
			myConn();
				$q = mysql_query(sprintf("INSERT INTO t_customer (
				kode,
				nama,
				alamat,
				contact,
				kecamatan,
				kota,
				telp,
				tempat_lahir,
				tgl_lahir,
				jenis_usaha,
				jasa_produksi,
				prospect_first_cust,
				tipe,
				uio,
				decision,
				jenis_badan_usaha,
				segmen,
				score,
				omzet,
				lama_usaha,
				lokasi_usaha,
				networking,
				salesman,
				foto,urut
				) VALUES (
				%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,'$foto1',%s)",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama_usaha'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['contact'])),
				quote_smart(trim($_POST['kecamatan'])),
				quote_smart(trim($_POST['kota'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['tempat_lahir'])),
				quote_smart($tgl),
				quote_smart(trim($_POST['jenis_usaha'])),
				quote_smart(trim($_POST['jasa_produksi'])),
				quote_smart(trim($_POST['prospect_first_cust'])),
				quote_smart(trim($_POST['tipe'])),
				quote_smart(trim($_POST['uio'])),
				quote_smart(trim($_POST['decision'])),
				quote_smart(trim($_POST['jenis_badan_usaha'])),
				quote_smart(trim($segmen)),
				quote_smart(trim($score)),
				quote_smart(trim($_POST['omzet'])),
				quote_smart(trim($_POST['lama_usaha'])),
				quote_smart(trim($_POST['lokasi_usaha'])),
				quote_smart(trim($_POST['networking'])),
				quote_smart(trim($ARSESS[1])),
				quote_smart(trim($_POST['kodeh']))
				)) or die(mysql_error());
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";		
}else{
				echo "<div id=\"errbox\">";		
				echo "format gambar<b>".$tipe."</b>&nbsp; harusnya<b> jpeg</b><br>";
				echo "</div>";
  				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";

}
}else{
			myConn();
								$q = mysql_query(sprintf("INSERT INTO t_customer (
				kode,
				nama,
				alamat,
				contact,
				kecamatan,
				kota,
				telp,
				tempat_lahir,
				tgl_lahir,
				jenis_usaha,
				jasa_produksi,
				prospect_first_cust,
				tipe,
				uio,
				decision,
				jenis_badan_usaha,
				segmen,
				score,
				omzet,
				lama_usaha,
				lokasi_usaha,
				networking,
				salesman,
				urut
				) VALUES (
				%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama_usaha'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['contact'])),
				quote_smart(trim($_POST['kecamatan'])),
				quote_smart(trim($_POST['kota'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['tempat_lahir'])),
				quote_smart($tgl),
				quote_smart(trim($_POST['jenis_usaha'])),
				quote_smart(trim($_POST['jasa_produksi'])),
				quote_smart(trim($_POST['prospect_first_cust'])),
				quote_smart(trim($_POST['tipe'])),
				quote_smart(trim($_POST['uio'])),
				quote_smart(trim($_POST['decision'])),
				quote_smart(trim($_POST['jenis_badan_usaha'])),
				quote_smart(trim($segmen)),
				quote_smart(trim($score)),
				quote_smart(trim($_POST['omzet'])),
				quote_smart(trim($_POST['lama_usaha'])),
				quote_smart(trim($_POST['lokasi_usaha'])),
				quote_smart(trim($_POST['networking'])),
				quote_smart(trim($ARSESS[1])),
				quote_smart(trim($_POST['kodeh']))
				)) or die(mysql_error());
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";
}	

}else{ //kalau update
myconn();
$fotoku=mysql_fetch_array(mysql_query("select foto from t_customer where kode='$_GET[eid]'"));
if($fotoku['foto']!=""){
	unlink("./img_customer/$fotoku[foto]");
}
if($foto){ //jika ada file yang di upload
if($fotoku['foto']!=""){
	unlink("./img_customer/$fotoku[foto]");
}
	if($tipe=="image/jpeg"){
    UploadImagecustomer($foto1,$size,$asal);
				//// good to go
				myConn();
				$q = mysql_query(sprintf("update t_customer set 
				kode=%s,
				nama=%s,
				alamat=%s,
				contact=%s,
				kecamatan=%s,
				kota=%s,
				telp=%s,
				tempat_lahir=%s,
				tgl_lahir=%s,
				jenis_usaha=%s,
				jasa_produksi=%s,
				prospect_first_cust=%s,
				tipe=%s,
				uio=%s,
				decision=%s,
				jenis_badan_usaha=%s,
				segmen=%s,
				score=%s,
				omzet=%s,
				lama_usaha=%s,
				lokasi_usaha=%s,
				networking=%s,
				salesman=%s,
				foto='$foto1' where kode='$_GET[eid]'",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama_usaha'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['contact'])),
				quote_smart(trim($_POST['kecamatan'])),
				quote_smart(trim($_POST['kota'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['tempat_lahir'])),
				quote_smart(trim($tgl)),
				quote_smart(trim($_POST['jenis_usaha'])),
				quote_smart(trim($_POST['jasa_produksi'])),
				quote_smart(trim($_POST['prospect_first_cust'])),
				quote_smart(trim($_POST['tipe'])),
				quote_smart(trim($uio)),
				quote_smart(trim($_POST['decision'])),
				quote_smart(trim($_POST['jenis_badan_usaha'])),
				quote_smart(trim($segmen)),
				quote_smart(trim($score)),
				quote_smart(trim($_POST['omzet'])),
				quote_smart(trim($_POST['lama_usaha'])),
				quote_smart(trim($_POST['lokasi_usaha'])),
				quote_smart(trim($_POST['networking'])),
				quote_smart(trim($ARSESS[1])),
				quote_smart(trim($_POST['kodeh']))
				)) or die(mysql_error());
				mysql_close();
				
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated...";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";
	
}else{
				echo "<div id=\"errbox\">";		
				echo "format gambar<b>".$tipe."</b>&nbsp; harusnya<b> jpeg</b><br>";
				echo "</div>";
  				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";

}
}else{

myConn();
$q = mysql_query(sprintf("update t_customer set 
				kode=%s,
				nama=%s,
				alamat=%s,
				contact=%s,
				kecamatan=%s,
				kota=%s,
				telp=%s,
				tempat_lahir=%s,
				tgl_lahir=%s,
				jenis_usaha=%s,
				jasa_produksi=%s,
				prospect_first_cust=%s,
				tipe=%s,
				uio=%s,
				decision=%s,
				jenis_badan_usaha=%s,
				segmen=%s,
				score=%s,
				omzet=%s,
				lama_usaha=%s,
				lokasi_usaha=%s,
				networking=%s,
				salesman=%s,foto=''
				 where kode='$_GET[eid]'",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama_usaha'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['contact'])),
				quote_smart(trim($_POST['kecamatan'])),
				quote_smart(trim($_POST['kota'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['tempat_lahir'])),
				quote_smart(trim($tgl)),
				quote_smart(trim($_POST['jenis_usaha'])),
				quote_smart(trim($_POST['jasa_produksi'])),
				quote_smart(trim($_POST['prospect_first_cust'])),
				quote_smart(trim($_POST['tipe'])),
				quote_smart(trim($uio)),
				quote_smart(trim($_POST['decision'])),
				quote_smart(trim($_POST['jenis_badan_usaha'])),
				quote_smart(trim($segmen)),
				quote_smart(trim($score)),
				quote_smart(trim($_POST['omzet'])),
				quote_smart(trim($_POST['lama_usaha'])),
				quote_smart(trim($_POST['lokasi_usaha'])),
				quote_smart(trim($_POST['networking'])),
				quote_smart(trim($ARSESS[1])),
				quote_smart(trim($_POST['kodeh']))
				)) or die(mysql_error());
				mysql_close();
				
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated...";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=master&action=cust>";
				}


}	

	

}
}
}
	?>

<h2>      &nbsp;</h2>
</div>


