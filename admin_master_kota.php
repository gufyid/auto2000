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
myConn();
$quv = mysql_query("SELECT * FROM t_kota ORDER BY id ASC") or die(mysql_error());
$jum_vendor=mysql_num_rows($quv);
mysql_close();
$nuv = mysql_numrows($quv);
if($_GET['x']=="0"){
myconn();
$data=mysql_fetch_array(mysql_query("select * from t_kota where id='$_GET[eid]'"));
}elseif($_GET['x']=="1"){
myConn();
$quv = mysql_query("delete from t_kota where id='$_GET[eid]'") or die(mysql_error());
				//echo "<div id=\"okbox\">";		
				//echo "Data berhasil dihapus";		
				//echo "</div>";
echo "<script type=\"text/javascript\">";
echo "alert('Data berhasil dihapus!!!')";
echo "</script>";				

//include ('./includes/del_satuan.php');
$quv = mysql_query("SELECT * FROM t_kota ORDER BY id ASC") or die(mysql_error());
mysql_close();
$nuv = mysql_numrows($quv);
//$_GET['x']=="3";
//				echo "<meta http-equiv=\"refresh\" content=\"1;URL=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=satuan\"\">";
echo "Anda dalam mode disable, untuk input <b>Jenis</b> baru anda harus klik <a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=data\"\"><b>Disini</b></a>";
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
th{text-align:center;padding:.5em;border:1px solid #fff;}
td{text-align:left;padding:.5em;border:1px solid #fff;}
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
	
<div id="boxy">
<fieldset>
<form method="post" action="#">
<div id="ki">Nama Kota</div>
<div id="ka"><input type="text" name="kota" id="kota" size="20" value="<?php echo $data[nama];?>"/></div>
<div id="divider"></div>
<div id="divider"></div>

<div id="ki">Status</div>
<div id="ka"><select name="status" id="status" />
<?php
if($data['status']=='black'){
echo "<option value=\"black\" selected=\"selected\">Black</option>";
echo "<option value=\"red\">Red</option>";
echo "<option value=\"yellow\">Yellow</option>";
echo "<option value=\"green\">Green</option>";
}elseif($data['status']=='red'){
echo "<option value=\"black\">Black</option>";
echo "<option value=\"red\" selected=\"selected\">Red</option>";
echo "<option value=\"yellow\">Yellow</option>";
echo "<option value=\"green\">Green</option>";
}elseif($data['status']=='yellow'){
echo "<option value=\"black\">Black</option>";
echo "<option value=\"red\">Red</option>";
echo "<option value=\"yellow\" selected=\"selected\">Yellow</option>";
echo "<option value=\"green\">Green</option>";
}elseif($data['status']=='green'){
echo "<option value=\"black\">Black</option>";
echo "<option value=\"red\">Red</option>";
echo "<option value=\"yellow\">Yellow</option>";
echo "<option value=\"green\" selected=\"selected\">Green</option>";
}else{
echo "<option value=\"\" selected=\"\">Pilih </option>";
echo "<option value=\"black\">Black</option>";
echo "<option value=\"red\">Red</option>";
echo "<option value=\"yellow\">Yellow</option>";
echo "<option value=\"green\">Green</option>";
}
?>
</select>

</div>
<hr />
<input type="reset" value="Reset"/>&nbsp;<input type="submit" name="btx" value="Add"/>
</fieldset>
</form>
<table cellspacing="0" cellpadding="0">			
	<tr>				
		<th>No</th>
		<th>Nama Kota</th>
		<th>Status Area</th>
		<th>Tools</th>
	</tr>
<?php
   for($iuv=0;$iuv<$nuv;$iuv++){
   	  $auv = mysql_fetch_array($quv);
      //
   	  $view = "<tr>";
	  $view.= "<td width=\"40\">";
	  $view.= number_format($iuv + 1);
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= $auv['nama'];
	  $view.= "</td>";	
	  $view.= "<td>";
	  $view.= $auv['status'];
	  $view.= "</td>";	
	  $view.= "<td width=\"40\">";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=kota&amp;eid=$auv[id]&x=0\">";
	  $view.= "edit";
	  $view.= "</a>&nbsp;&nbsp;";
	  $view.= "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=kota&amp;eid=$auv[id]&x=1\">";
	  $view.= "delete";
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
if(empty($_POST['kota'])){
		echo "<div id=\"errbox\">";		
		echo "You did not fill all required fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";		
		echo "</div>";
	} else {
	if(($_GET['x']!="0"))
	{
				
				//// good to go
				myConn();
				$q = mysql_query(sprintf("INSERT INTO t_kota (
				nama,status
				) VALUES (
				%s,%s)",
				quote_smart($_POST['kota']),
				quote_smart($_POST['status'])
				)) or die(mysql_error());
				mysql_close();
				echo "<div id=\"okbox\">";		
				echo "A new record has been added";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=kota>";
				
}else{
myConn();
				$q = mysql_query("update t_kota set 
				nama='$_POST[kota]',
				status='$_POST[status]'	
				where id='$_GET[eid]'"
				);
				mysql_close();
				
				echo "<div id=\"okbox\">";		
				echo "A new record has been updated...";		
				echo "</div>";
				echo "<meta http-equiv=refresh content=2;url=?c=admin&sub=master&action=kota>";

}	

	

}
}
	?>

<h2>      &nbsp;</h2>
</div>


