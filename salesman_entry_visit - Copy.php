<?php
echo "<meta http-equiv=\"Expires\" content=\"0\"/>";

/**
 * @author gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
getLevelThreeTitle($ACL2ID,$_GET['action']);
echo "<h3>$LV2TITLE | $LV3TITLE</h3>";
if(!isset($_POST['btx'])){
$tgl=$_GET['tgl'];
$cust=$_GET['cust'];
myConn();
$kunjungan=mysql_fetch_array(mysql_query("select * from t_kunjungan where tgl='$tgl' and customer='$cust' and salesman='$ARSESS[1]'"));
?>
<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script> 
<link rel="stylesheet" href="./styles/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script src="./libs/jquery.js" type="text/javascript" charset="utf-8"></script>	
<script src="./libs/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<script src="./ajax/ajax_7step.js" type="text/javascript" charset="utf-8"></script>	

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
	
<div id="boxy" >
<form method="post" action="#" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
<td>Tanggal Visit</td>
<td><input type="text" class="small" name="tgl" id="tgl" readonly="readonly" value="<?php echo $kunjungan['tgl'];?>"/></td>
<td><input type="hidden" name="kodeh" value="<?php echo $_GET['x'];?>"></td>
<td><input type="hidden" name="kunjunganh" value="<?php echo $kunjungan['id'];?>"></td>
</tr>
</table>
<hr />
<table width="100%" border="0">
<tr>
<td>Customer</td>
<td><select name="customer" id="customer"/>
<option value="" selected="selected">Pilih</option>
<?php
myconn();
if($ARSESS[0]=='1'){
$q=mysql_query("select * from t_customer order by nama");
}else{
$q=mysql_query("select * from t_customer where salesman='$ARSESS[1]' order by nama");
}
while($dtq=mysql_fetch_array($q)){
if($kunjungan['customer']==$dtq['kode']){
echo "<option value=$dtq[kode] selected=\"selected\">$dtq[nama]</option>";
}else{
echo "<option value=$dtq[kode]>$dtq[nama]</option>";

}
}
?>
</select>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>7Step</td>
<td><select name="sevenstep" id="sevenstep" onchange="process_7step()"/>
<option value="" selected="selected">Pilih</option>
<?php
$q=mysql_query("select * from t_sevenstep order by id");
while($dtq=mysql_fetch_array($q)){
if($dtq['id']==$kunjungan['sevenstep']){
echo "<option value=$dtq[id] selected=\"selected\">$dtq[nama]</option>";
}else{
echo "<option value=$dtq[id]>$dtq[nama]</option>";
}
}
?>
</select>
&nbsp;&nbsp;<label id="hasil"></label>&nbsp;&nbsp;<label id="hasil_loss"></label>

</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>Keterangan</td>
<td><textarea name="keterangan" id="keterangan" cols="30" rows="10"><?php echo $q['keterangan'];?></textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>


</table>
<hr />
<input type="submit" name="btx" value="Tambah"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>

<?php
}else{
if(empty($_POST['tgl'])||empty($_POST['customer'])||empty($_POST['sevenstep'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
	if($_POST['kodeh']=='1'){
	$tgl=explode("/",$_POST['tgl']);
	$tgl=$tgl[2]."-".$tgl[1]."-".$tgl[0];
				//// good to go
			myConn();
				$q = mysql_query(sprintf("update t_kunjungan set
				salesman='$ARSESS[1]',
				tgl='$tgl',
				customer=%s,
				sevenstep=%s,
				deal_loss=%s,
				status_loss=%s,
				keterangan=%s where id='$_POST[kunjunganh]'
				",
				quote_smart(trim($_POST['customer'])),
				quote_smart(trim($_POST['sevenstep'])),
				quote_smart(trim($_POST['close'])),
				quote_smart(trim($_POST['loss'])),
				quote_smart(trim($_POST['keterangan']))
				)) or die(mysql_error());
				$akhir=mysql_insert_id();
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=visit>";		

				if($_POST['sevenstep']=='7'){
echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=after&cust=$_POST[customer]&akhir=$akhir>";		
}

	
	}else{
//	echo $_POST['loss'];
	$tgl=explode("/",$_POST['tgl']);
	$tgl=$tgl[2]."-".$tgl[1]."-".$tgl[0];
				//// good to go
			myConn();
				$q = mysql_query(sprintf("INSERT INTO t_kunjungan (
				salesman,
				tgl,
				customer,
				sevenstep,
				deal_loss,
				status_loss,
				keterangan
				) VALUES (
				'$ARSESS[1]','$tgl',%s,%s,%s,%s,%s)",
				quote_smart(trim($_POST['customer'])),
				quote_smart(trim($_POST['sevenstep'])),
				quote_smart(trim($_POST['close'])),
				quote_smart(trim($_POST['loss'])),
				quote_smart(trim($_POST['keterangan']))
				)) or die(mysql_error());
$akhir=mysql_insert_id();
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=visit>";		

				if($_POST['sevenstep']=='7'){
echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=after&cust=$_POST[customer]&akhir=$akhir>";		
}
				}
				}
}
	?>

<h2>      &nbsp;</h2>
</div>


