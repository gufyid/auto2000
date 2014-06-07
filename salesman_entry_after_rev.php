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
$eid=$_GET['eid'];
myConn();
$q=mysql_fetch_array(mysql_query("select * from t_after_sales where id_kunjungan='$eid'"));
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

<!--
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
-->
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
<?php
$y=0;
for($i=1;$i<=10;$i++){
if(($q['tgl_stnk'.$i]!='0000-00-00') || (!empty($q['no_rangka'.$i]))){

echo "<div id=\"ki\">No Rangka $i</div>";
echo "<div id=\"ka\"><input type=\"text\" class=\"small\" name=\"no_rangka$i\" id=\"no_rangka$i\"  value='".$q['no_rangka'.$i]."'/></div>";
echo "<div id=\"divider\"></div>";
echo "<div id=\"divider\"></div>";

echo "<div id=\"ki\">Tgl STNK $i</div>";
echo "<div id=\"ka\"><input type=\"text\" class=\"small\" name=\"tgl_stnk$i\" id=\"tgl_stnk$i\"  value='".$q['tgl_stnk'.$i]."'/></div>";
echo "<div id=\"divider\"></div>";
echo "<div id=\"divider\"></div>";
$y++;
}
}
?>

<div id="ki">Plan DEC</div>
<div id="ka"><input type="text" class="small" name="dec" id="dec"  value="<?php echo $q['del'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>

<input type="hidden" name="xh" value="<?php echo $y;?>">
<input type="hidden" name="eidh" value="<?php echo $_GET['eid'];?>">

<div id="ki">Plan CR1</div>
<div id="ka"><input type="text" class="small" name="cr1" id="cr1"  value="<?php echo $q['cr1'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Plan CR2</div>
<div id="ka"><input type="text" class="small" name="cr2" id="cr2"  value="<?php echo $q['cr2'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">Plan CR3</div>
<div id="ka"><input type="text" class="small" name="cr3" id="cr3"  value="<?php echo $q['cr3'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">20.000 KM</div>
<div id="ka"><input type="text" class="small" name="dua_puluh" id="dua_puluh" value="<?php echo $q['dua_puluh'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">30.000 KM</div>
<div id="ka"><input type="text" class="small" name="tiga_puluh" id="tiga_puluh"  value="<?php echo $q['tiga_puluh'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>



<div id="ki">40.000 KM</div>
<div id="ka"><input type="text" class="small" name="empat_puluh" id="empat_puluh" value="<?php echo $q['empat_puluh'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<div id="ki">50.000 KM</div>
<div id="ka"><input type="text" class="small" name="lima_puluh" id="lima_puluh"  value="<?php echo $q['lima_puluh'];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>


<input type="submit" name="btx" value="Update"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>

<?php
}else{
	$dec=$_POST['dec'];
	$cr1=$_POST['cr1'];
	$cr2=$_POST['cr2'];
	$cr3=$_POST['cr3'];
	$dua_puluh=$_POST['dua_puluh'];
	$tiga_puluh=$_POST['tiga_puluh'];
	$empat_puluh=$_POST['empat_puluh'];
	$lima_puluh=$_POST['lima_puluh'];

$x=$_POST['xh'];
$eid=$_POST['eidh'];

$tglku=array();
$no_rangkaku=array();
for($i=1;$i<=$x;$i++){
$tgl=$_POST['tgl_stnk'.$i];
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
				$q = "update t_after_sales set
				del='$dec',
				cr1='$cr1',
				cr2='$cr1',
				cr3='$cr1',
				dua_puluh='$dua_puluh',
				tiga_puluh='$tiga_puluh',
				empat_puluh='$empat_puluh',
				lima_puluh='$lima_puluh',
				no_rangka1='$no_rangkaku[0]',
				no_rangka2='$no_rangkaku[1]',
				no_rangka3='$no_rangkaku[2]',
				no_rangka4='$no_rangkaku[3]',
				no_rangka5='$no_rangkaku[4]',
				no_rangka6='$no_rangkaku[5]',
				no_rangka7='$no_rangkaku[6]',
				no_rangka8='$no_rangkaku[7]',
				no_rangka9='$no_rangkaku[8]',
				no_rangka10='$no_rangkaku[9]',
				tgl_stnk1='$tglku1',
				tgl_stnk2='$tglku2',
				tgl_stnk3='$tglku3',
				tgl_stnk4='$tglku4',
				tgl_stnk5='$tglku5',
				tgl_stnk6='$tglku6',
				tgl_stnk7='$tglku7',
				tgl_stnk8='$tglku8',
				tgl_stnk9='$tglku9',
				tgl_stnk10='$tglku10' where id_kunjungan='$eid'";
				
mysql_query($q);
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been Updated";		
				echo "</div>";
//	echo $q;
			echo "<meta http-equiv=refresh content=2;url=?c=salesman&sub=entry&action=revvisit>";		
}
	?>

<h2>      &nbsp;</h2>
</div>


