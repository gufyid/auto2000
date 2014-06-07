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
echo $_GET['x'];
//$tgl= date("d/m/Y");
$tgl=explode("/",date("d/m/Y"));
$tgl1=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+7,$tgl[2]));
$tgl2=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+30,$tgl[2]));
$tgl3=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+60,$tgl[2]));

$tgl4=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+120,$tgl[2]));
$tgl5=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+180,$tgl[2]));
$tgl6=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+240,$tgl[2]));
$tgl7=date("d/m/Y",mktime(0,0,0,$tgl[1],$tgl[0]+300,$tgl[2]));
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
	$("#dec").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
	//
	$("#cr1").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
	//
	$("#cr2").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
//
	$("#cr3").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
//
	$("#dua_puluh").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
//
	$("#tiga_puluh").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
//
	$("#empat_puluh").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
//
	$("#lima_puluh").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-0:1' 
	}
	);
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
<div id="ki">Jumlah Unit</div>
<div id="ka"><select name="jum_unit" id="jum_unit" onchange='process_jum_unit()'/>
<option value="" selected="selected">Pilih</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
</div>
<div id="divider"></div>
<div id="ka"><div id="hasil_unit"></div></div>
<div id="divider"></div>

<div id="ki">Plan DEC</div>
<div id="ka"><input type="text" class="small" name="dec" id="dec" readonly="readonly" value="<?php echo date("d/m/Y");?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Plan CR1</div>
<div id="ka"><input type="text" class="small" name="cr1" id="cr1" readonly="readonly" value="<?php echo $tgl1;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Plan CR2</div>
<div id="ka"><input type="text" class="small" name="cr2" id="cr2" readonly="readonly" value="<?php echo $tgl2;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Plan CR3</div>
<div id="ka"><input type="text" class="small" name="cr3" id="cr3" readonly="readonly" value="<?php echo $tgl3;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">20.000 KM</div>
<div id="ka"><input type="text" class="small" name="dua_puluh" id="dua_puluh" readonly="readonly" value="<?php echo $tgl4;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">30.000 KM</div>
<div id="ka"><input type="text" class="small" name="tiga_puluh" id="tiga_puluh" readonly="readonly" value="<?php echo $tgl5;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">40.000 KM</div>
<div id="ka"><input type="text" class="small" name="empat_puluh" id="empat_puluh" readonly="readonly" value="<?php echo $tgl6;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">50.000 KM</div>
<div id="ka"><input type="text" class="small" name="lima_puluh" id="lima_puluh" readonly="readonly" value="<?php echo $tgl7;?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<input type="submit" name="btx" value="Tambah"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>

<?php
}else{
if(empty($_POST['dec'])||empty($_POST['cr1']) ||empty($_POST['cr2'])||empty($_POST['cr3'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
	$dec=explode("/",$_POST['dec']);
	$dec=$dec[2]."-".$dec[1]."-".$dec[0];
	$cr1=explode("/",$_POST['cr1']);
	$cr1=$cr1[2]."-".$cr1[1]."-".$cr1[0];
	$cr2=explode("/",$_POST['cr2']);
	$cr2=$cr2[2]."-".$cr2[1]."-".$cr2[0];
	$cr3=explode("/",$_POST['cr3']);
	$cr3=$cr3[2]."-".$cr3[1]."-".$cr3[0];
	$dua_puluh=explode("/",$_POST['dua_puluh']);
	$dua_puluh=$dua_puluh[2]."-".$dua_puluh[1]."-".$dua_puluh[0];
	$tiga_puluh=explode("/",$_POST['tiga_puluh']);
	$tiga_puluh=$tiga_puluh[2]."-".$tiga_puluh[1]."-".$tiga_puluh[0];
	$empat_puluh=explode("/",$_POST['empat_puluh']);
	$empat_puluh=$empat_puluh[2]."-".$empat_puluh[1]."-".$empat_puluh[0];
	$lima_puluh=explode("/",$_POST['lima_puluh']);
	$lima_puluh=$lima_puluh[2]."-".$lima_puluh[1]."-".$lima_puluh[0];

$x=$_POST['xh'];
$tglku=array();
$no_rangkaku=array();
for($i=1;$i<=$x;$i++){
$tgl=explode("/",$_POST['tgl_stnk'.$i]);
$tgl=$tgl[2]."-".$tgl[1]."-".$tgl[0];
$no_rangka=$_POST['no_rangka'.$i];
array_push($tglku,$tgl);
array_push($no_rangkaku,$no_rangka);
}
if(!empty($tglku[0])){
$tglku1=$tglku[0];
}else{
$tglku1="000-00-00";
}

if(!empty($tglku[1])){
$tglku2=$tglku[1];
}else{
$tglku2="000-00-00";
}

if(!empty($tglku[2])){
$tglku3=$tglku[2];
}else{
$tglku3="000-00-00";
}

if(!empty($tglku[3])){
$tglku4=$tglku[3];
}else{
$tglku4="000-00-00";
}

if(!empty($tglku[4])){
$tglku5=$tglku[4];
}else{
$tglku5="000-00-00";
}

if(!empty($tglku[5])){
$tglku6=$tglku[5];
}else{
$tglku6="000-00-00";
}

if(!empty($tglku[6])){
$tglku7=$tglku[6];
}else{
$tglku7="000-00-00";
}

if(!empty($tglku[7])){
$tglku8=$tglku[7];
}else{
$tglku8="000-00-00";
}

if(!empty($tglku[8])){
$tglku9=$tglku[8];
}else{
$tglku9="000-00-00";
}

if(!empty($tglku[9])){
$tglku10=$tglku[9];
}else{
$tglku10="000-00-00";
}

//echo "$tglku[0]$nbsp;$tglku[1]";
	//// good to go

			myConn();
				$q = "INSERT INTO t_after_sales (
				id_kunjungan,
				customer,
				salesman,
				jumlah,
				del,
				cr1,
				cr2,
				cr3,
				dua_puluh,
				tiga_puluh,
				empat_puluh,
				lima_puluh,
				no_rangka1,
				no_rangka2,
				no_rangka3,
				no_rangka4,
				no_rangka5,
				no_rangka6,
				no_rangka7,
				no_rangka8,
				no_rangka9,
				no_rangka10,
				tgl_stnk1,
				tgl_stnk2,
				tgl_stnk3,
				tgl_stnk4,
				tgl_stnk5,
				tgl_stnk6,
				tgl_stnk7,
				tgl_stnk8,
				tgl_stnk9,
				tgl_stnk10
				) VALUES (
				'$_GET[akhir]','$_GET[cust]','$ARSESS[1]','$_POST[jum_unit]','$dec','$cr1','$cr2','$cr3','$dua_puluh','$tiga_puluh','$empat_puluh','$lima_puluh',
				'$no_rangkaku[0]','$no_rangkaku[1]','$no_rangkaku[2]','$no_rangkaku[3]','$no_rangkaku[4]','$no_rangkaku[5]','$no_rangkaku[6]','$no_rangkaku[7]'
				,'$no_rangkaku[8]','$no_rangkaku[9]','$tglku1','$tglku2','$tglku3','$tglku4','$tglku5','$tglku6','$tglku7'
				,'$tglku8','$tglku9','$tglku10')";
mysql_query($q);
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
		//		ECHO $q;
			echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=visit>";		
}
}
	?>

<h2>      &nbsp;</h2>
</div>


