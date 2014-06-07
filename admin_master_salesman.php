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
include "salesman_detail.php";
}else{

if(!isset($_POST['btx'])){
myConn();
$quv = mysql_query("SELECT * FROM t_salesman ORDER BY id ASC") or die(mysql_error());
$jum_vendor=mysql_num_rows($quv);
mysql_close();
$nuv = mysql_numrows($quv);
if($_GET['x']=="0"){
myconn();
$data=mysql_fetch_array(mysql_query("select * from t_salesman where id='$_GET[eid]'"));
}elseif($_GET['x']=="1"){
myConn();
$quv = mysql_query("delete from t_salesman where id='$_GET[eid]'") or die(mysql_error());
				//echo "<div id=\"okbox\">";		
				//echo "Data berhasil dihapus";		
				//echo "</div>";
echo "<script type=\"text/javascript\">";
echo "alert('Data berhasil dihapus!!!')";
echo "</script>";				

//include ('./includes/del_satuan.php');
$quv = mysql_query("SELECT * FROM t_salesman ORDER BY id ASC") or die(mysql_error());
mysql_close();
$nuv = mysql_numrows($quv);
//$_GET['x']=="3";
//				echo "<meta http-equiv=\"refresh\" content=\"1;URL=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=satuan\"\">";
echo "Anda dalam mode disable, untuk input <b>Jenis</b> baru anda harus klik <a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=salesman\"\"><b>Disini</b></a>";
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
<fieldset>
<form method="post" action="#" enctype="multipart/form-data">

<div id="ki">Kode / NIK</div>
<div id="ka"><input type="text" name="kode" id="kode" size="25" value="<?php echo $data[kode];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Nama Salesman</div>
<div id="ka"><input type="text" name="nama" id="nama" size="50" value="<?php echo $data[nama];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Alamat</div>
<div id="ka"><textarea name="alamat" id="alamat" cols="30" rows="10"><?php echo $data['alamat'];?></textarea></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">No Telepon</div>
<div id="ka"><input type="text" name="telp" id="telp" size="50" value="<?php echo $data[telp];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Email</div>
<div id="ka"><input type="text" name="email" id="email" size="50" value="<?php echo $data[email];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Supervisor</div>
<div id="ka"><select name="spv" id="spv"/>
<option value="" selected="selected">Pilih</option>
<?php
myConn();
$spv=mysql_query("select * from t_supervisor order by id");
while($dtspv=mysql_fetch_array($spv)){
if($dtspv['kode']==$data['spv']){
echo "<option value=$dtspv[kode] selected=\"selected\">$dtspv[nama]</option>";
}else{
echo "<option value=$dtspv[kode]>$dtspv[nama]</option>";
}
}
?>
</select>
</div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Foto</div>
<div id="ka"><input type="file" name="foto" id="foto"/>&nbsp;Jpeg Only</div>
<div id="divider"></div>
<div id="divider"></div>



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
		<th>Telepon</th>
		<th>Email</th>
		<th>Supervisor</th>
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
	  $view.= ucwords($auv['telp']);
	  $view.= "</td>";  
	  $view.= "<td>";
	  $view.= ucwords($auv['email']);
	  $view.= "</td>";  
	  myconn();
	  $spv=mysql_fetch_array(mysql_query("select nama from t_supervisor where kode='$auv[spv]'"));
	  $view.= "<td>";
	  $view.= ucwords($spv['nama']);
	  $view.= "</td>";  

	  $view.= "<td width=\"40\">";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=salesman&amp;eid=$auv[id]&x=0\">";
	  $view.= "edit";
	  $view.= "</a>&nbsp;&nbsp;";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=salesman&amp;eid=$auv[id]&x=1\">";
	  $view.= "delete";
	  $view.= "</a>&nbsp;&nbsp;";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=salesman&amp;eid=$auv[id]&x=2\">";
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
if(empty($_POST['kode'])||empty($_POST['nama'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
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
    UploadImagesalesman($foto1,$size,$asal);
				//// good to go
	
myConn();
				$q = mysql_query(sprintf("INSERT INTO t_salesman (
				kode,
				nama,
				alamat,
				telp,
				email,
				spv,
				foto
				) VALUES (
				%s,%s,%s,%s,%s,%s,'$foto1')",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['email'])),
				quote_smart(trim($_POST['spv']))
				)) or die(mysql_error());
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";
	}else{
				echo "<div id=\"errbox\">";		
				echo "format gambar<b>".$tipe."</b>&nbsp; harusnya<b> jpeg</b><br>";
				echo "</div>";
  				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";

}
}else{ //jika tidak ada foto yang di upload
myConn();
				$q = mysql_query(sprintf("INSERT INTO t_salesman (
				kode,
				nama,
				alamat,
				telp,
				email,
				spv
				) VALUES (
				%s,%s,%s,%s,%s,%s)",
				quote_smart($_POST['kode']),
				quote_smart(trim($_POST['nama'])),
				quote_smart(trim($_POST['alamat'])),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['email'])),
				quote_smart(trim($_POST['spv']))
				)) or die(mysql_error());
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";

}	
				
}else{ //kalau update
myconn();
$fotoku=mysql_fetch_array(mysql_query("select foto from t_salesman where id='$_GET[eid]'"));
if($foto){ //jika ada foto yang di upload
unlink("./img_salesman/$fotoku[foto]");
	if($tipe=="image/jpeg"){
    UploadImagesalesman($foto1,$size,$asal);
				//// good to go
	
myConn();
				$q = mysql_query(sprintf("update t_salesman set 
				kode='$_POST[kode]',
				nama=%s,
				alamat=%s,
				spv=%s,
				telp=%s,
				email=%s,
				foto='$foto1' where id='$_GET[eid]'",
				quote_smart($_POST['nama']),
				quote_smart($_POST['alamat']),
				quote_smart($_POST['spv']),
				quote_smart(trim($_POST['telp'])),
				quote_smart(trim($_POST['email']))
				)) or die(mysql_error());
				mysql_close();
				
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated...";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";
}else{
				echo "<div id=\"errbox\">";		
				echo "format gambar<b>".$tipe."</b>&nbsp; harusnya<b> jpeg</b><br>";
				echo "</div>";
  				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";

}

}else{
myConn();
				$q = mysql_query(sprintf("update t_salesman set 
				kode='$_POST[kode]',
				nama=%s,
				alamat=%s,
				spv=%s,
				email=%s,
				telp=%s where id='$_GET[eid]'",
				quote_smart($_POST['nama']),
				quote_smart($_POST['alamat']),
				quote_smart($_POST['spv']),
				quote_smart($_POST['email']),
				quote_smart(trim($_POST['telp']))
				)) or die(mysql_error());
				mysql_close();
				
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated...";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=salesman>";

}

}	

	

}
}
}
	?>

<h2>      &nbsp;</h2>
</div>


