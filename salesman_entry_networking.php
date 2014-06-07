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
<fieldset>

<form method="post" action="#" enctype="multipart/form-data">

<div id="ki">Tanggal Visit</div>
<div id="ka"><input type="text" name="tgl" id="tgl" readonly="readonly"/></div>

<div id="ki">Customer</div>
<div id="ka"><select name="customer" id="customer"/>
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
</div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Jumlah Networking</div>
<div id="ka"><select name="networking" id="networking" onchange="process_networking()"/>
<option value="" selected="selected">Pilih</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
&nbsp;&nbsp;<div id="hasil_networking"></div>
</div>
<div id="divider"></div>
<div id="divider"></div>



<input type="submit" name="btx" value="Tambah"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>

<?php
}else{
if(empty($_POST['tgl'])||empty($_POST['customer'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
//	echo $_POST['loss'];
	$tgl=explode("/",$_POST['tgl']);
	$tgl=$tgl[2]."-".$tgl[1]."-".$tgl[0];
				//// good to go
			myConn();
			

for($i=1;$i<=$_POST['networking'];$i++){
$calon_customer=$_POST['calon_customer'.$i];
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

				$q = mysql_query(sprintf("INSERT INTO t_networking (
				tgl,
				customer,
				networking,
				calon_customer,
				salesman
				) VALUES (
				'$tgl',%s,'1','$calon_customer','$ARSESS[1]')",
				quote_smart(trim($_POST['customer']))
				)) or die(mysql_error());

		//insert calon customer
	
					$q = mysql_query(sprintf("INSERT INTO t_customer (
				kode,
				nama,
				salesman,
				urut
				) VALUES (
				'$kode',%s,'$ARSESS[1]','$urut')",
				quote_smart(trim($calon_customer))
				)) or die(mysql_error());

		
				}
$net=mysql_fetch_array(mysql_query("select networking from t_customer where kode='$_POST[customer]'"));
$networking_awal=$net['networking'];
$networking_total=$networking_awal + $_POST['networking'];

$qnet=mysql_query("update t_customer set networking='$networking_total' where kode='$_POST[customer]'");

				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=networking>";		
}
}
	?>

<h2>      &nbsp;</h2>
</div>


