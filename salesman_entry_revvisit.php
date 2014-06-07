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

<input type="submit" name="btx" value="Proses"/>&nbsp;<input type="reset" value="Batal"/>
</fieldset>
</form>

<?php
if(isset($_POST['btx'])){
if(empty($_POST['tgl'])){
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
			$q=mysql_query("select * from t_kunjungan where tgl='$tgl' and salesman='$ARSESS[1]'");
			 $jum=mysql_num_rows($q);
			 if($jum>0){
		$view="";
		$view.="<table>";
		$view.="<tr>";
		$view.="<th>No</th>";
		$view.="<th>Customer</th>";
		$view.="<th>Keterangan</th>";
		$view.="<th>Action</th>";
		$view.="</tr>";
		$no=0;
		while($dtq=mysql_fetch_array($q)){
		$no++;
		$customer=mysql_fetch_array(mysql_query("select * from t_customer where kode='$dtq[customer]'"));
		$cek_after=mysql_fetch_array(mysql_query("select count(*) as jum from t_after_sales where id_kunjungan='$dtq[id]'")); 
		$view.="<tr>";
		$view.="<td>$no</td>";
		$view.="<td>$customer[nama]</td>";
		$view.="<td>$dtq[keterangan]</td>";
		$view.="<td>";
    	$view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=visit&amp;eid=$dtq[id]&x=1\">";
		$view.= "edit kunjungan";
	    $view.= "</a>&nbsp;&nbsp;";
		if($cek_after['jum']>0){
	    $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=after_rev&amp;eid=$dtq[id]&x=1\">";
		$view.= "edit after sales";
	    $view.= "</a>";		
		}else{
		}
		$view.="</td>";
		$view.="<tr>";
	
		}
		$view.="</table>";
		echo $view;
		}else{
		echo "<div id=\"errbox\">";		
		echo "No Data";
		echo "</div>";

		}
				}
}
	?>

<h2>      &nbsp;</h2>
</div>


