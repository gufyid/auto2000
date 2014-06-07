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

<?php
//echo "<div><h1><center>Untuk SECURITY...fasilitas input Foto sudah tersedia!!!! <br><br> Terima Kasih </center></h1></div>";
/**
 * @author Gatot
 * @copyright 2009
 */
 /*
echo "<h1>S Y S T E M &nbsp;&nbsp; R E P O R T I N G</h1>";
echo "<ul>";
echo "<li>";
echo "Laporan Alat Pemadam Kebakaran";
echo "</li>";
echo "<li>";
echo "";
echo "</li>";
echo "</ul>";
*/
$x=$_GET['x'];
if($x==1){
myconn();
$q=mysql_query("select * from hr_license order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>HR & Other License Document</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Description</th>";
echo "<th>Number</th>";
echo "<th>Issued Date</th>";
echo "<th>Expiry Date</th>";
echo "<th>Doc</th>";
echo "<th>Detail/View</th>";
echo "</tr>";

$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_hr_license where kd_hr='$dtq[id]'"));
$file=mysql_query("select * from img_hr_license where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[description]</td>";
echo "<td>$dtq[num]</td>";
echo "<td>$dtq[issued_date]</td>";
echo "<td>$dtq[exp_date]</td>";
echo "<td>$dtq[doc]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_hr.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";
}
}elseif($x==2){
myconn();
$q=mysql_query("select * from wood_matter_license order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>Wood Matter License Document</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Description</th>";
echo "<th>Number</th>";
echo "<th>Issued Date</th>";
echo "<th>Expiry Date</th>";
echo "<th>Doc</th>";
echo "<th>Detail/View</th>";
echo "</tr>";

$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_wood_matter where kd_hr='$dtq[id]'"));
$file=mysql_query("select * from img_wood_matter where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[description]</td>";
echo "<td>$dtq[num]</td>";
echo "<td>$dtq[issued_date]</td>";
echo "<td>$dtq[exp_date]</td>";
echo "<td>$dtq[doc]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_wood.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==3){
myconn();
$q=mysql_query("select * from marsani_license order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>CV. IAGO Marsani License Document</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Description</th>";
echo "<th>Number</th>";
echo "<th>Issued Date</th>";
echo "<th>Expiry Date</th>";
echo "<th>Doc</th>";
echo "<th>Detail/View</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_marsani_license"));
$file=mysql_query("select * from img_marsani_license where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[description]</td>";
echo "<td>$dtq[num]</td>";
echo "<td>$dtq[issued_date]</td>";
echo "<td>$dtq[exp_date]</td>";
echo "<td>$dtq[doc]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_marsani.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";
}
}elseif($x==4){
myconn();
$q=mysql_query("select * from company_license order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>Company License Document</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Description</th>";
echo "<th>Number</th>";
echo "<th>Issued Date</th>";
echo "<th>Expiry Date</th>";
echo "<th>Doc</th>";
echo "<th>Detail/View</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_company_license"));
$file=mysql_query("select * from img_company_license where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[description]</td>";
echo "<td>$dtq[num]</td>";
echo "<td>$dtq[issued_date]</td>";
echo "<td>$dtq[exp_date]</td>";
echo "<td>$dtq[doc]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_company.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==5){
myconn();
$q=mysql_query("select * from law_label where negara='USA' order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>Law Label Document USA</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>State & Websites</th>";
echo "<th>Registration Number</th>";
echo "<th>Expiration Date</th>";
echo "<th>Status Now</th>";
echo "<th>Renewal Fee</th>";
echo "<th>Expiry Term</th>";
echo "<th>Detail/View</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$sakiki=date("Y-m-d");
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_law_label"));
$file=mysql_query("select * from img_law_label where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[state]</td>";
echo "<td>$dtq[reg_number]</td>";
echo "<td>$dtq[exp_date]</td>";
if($dtq['exp_date']>$sakiki){
echo "<td>Active</td>";
}else{
echo "<td>Expired</td>";
}
echo "<td>$dtq[renewal_fee]</td>";
echo "<td>$dtq[exp_term]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_lawlabel.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==6){
myconn();
$q=mysql_query("select * from law_label where negara='CANADA' order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>Law Label Document CANADA</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>State & Websites</th>";
echo "<th>Registration Number</th>";
echo "<th>Expiration Date</th>";
echo "<th>Status Now</th>";
echo "<th>Renewal Fee</th>";
echo "<th>Expiry Term</th>";
echo "<th>Detail/View</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$sakiki=date("Y-m-d");
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_law_label"));
$file=mysql_query("select * from img_law_label where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[state]</td>";
echo "<td>$dtq[reg_number]</td>";
echo "<td>$dtq[exp_date]</td>";
if($dtq['exp_date']>$sakiki){
echo "<td>Active</td>";
}else{
echo "<td>Expired</td>";
}
echo "<td>$dtq[renewal_fee]</td>";
echo "<td>$dtq[exp_term]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_lawlabel.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==7){
myconn();
$q=mysql_query("select * from label_other  order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>Law Label Document OTHER</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Certificate Number</th>";
echo "<th>Global Location Number</th>";
echo "<th>Company Prefix No</th>";
echo "<th>Expired Date</th>";
echo "<th>Main Contact</th>";
echo "<th>Alternative Contact</th>";
echo "<th>Address & Telp</th>";
echo "<th>Application Form</th>";
echo "<th>Renewal Fee</th>";
echo "<th>Remark</th>";
echo "<th>Detail/View</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
$jum_file=mysql_fetch_array(mysql_query("select count(*) as jum_file from img_label_other"));
$file=mysql_query("select * from img_label_other where kd_hr='$dtq[id]'");
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[certificate_number]</td>";
echo "<td>$dtq[glob_loc_number]</td>";
echo "<td>$dtq[comp_prefix_number]</td>";
echo "<td>$dtq[exp_date]</td>";
echo "<td>$dtq[main_contact]</td>";
echo "<td>$dtq[alternative_contact]</td>";
echo "<td>$dtq[address_telp]</td>";
echo "<td>$dtq[application_form]</td>";
echo "<td>$dtq[renewal_fee]</td>";
echo "<td>$dtq[remark]</td>";
echo "<td>";
$urut=0;
while($dtfile=mysql_fetch_array($file)){
$urut++;
//echo "<tr>";
echo "$urut.&nbsp;<a href=\"#\"  onclick=\"return window.open('includes/view/view_file_labelother.php?id=$dtfile[id]','View File','width=1366,height=768');return false\">$dtfile[file]</a><br />";
//echo "</tr>";
}
echo "</td>";
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==10){
myconn();
$q=mysql_query("select * from myjob order by id");
$cek_jum=mysql_num_rows($q);
if($cek_jum>0){
echo "<h2><center>List Of IT Jobs</center></h2>";
echo "<table>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Pelaksana</th>";
echo "<th>Jenis Pekerjaan</th>";
echo "<th>Tanggal Mulai</th>";
echo "<th>Tanggal Selesai</th>";
echo "<th>Status</th>";
echo "</tr>";
$no=0;
while($dtq=mysql_fetch_array($q)){
$no++;
echo "<tr>";
echo "<td>$no</td>";
echo "<td>$dtq[executor]</td>";
echo "<td>$dtq[jenis_pekerjaan]</td>";
echo "<td>$dtq[tgl_perintah]</td>";
echo "<td>$dtq[tgl_selesai]</td>";
if($dtq['status']=='1'){
echo "<td>Selesai</td>";
}else{
echo "<td>Prosess</td>";
}
echo "</tr>";
}
echo "</table>";
echo "<a href=\"?\">Back To Main Menu</a>";
}else{
		echo "<div id=\"errbox\">";		
		echo "No Data Found!";
		echo "</div>";
	echo "<meta http-equiv=refresh content=2;url=?>";

}
}elseif($x==8){
include "monitoring_expatriate.php";
echo "<a href=\"?\">Back To Main Menu</a>";
//}else{
	//	echo "<div id=\"errbox\">";		
		//echo "No Data Found!";
//		echo "</div>";

}else{
IF(($ARSESS[0]==79) || ($ARSESS[0]==59) || ($ARSESS[0]==1) || ($ARSESS[0]==87)){
echo "<h1>SUGGESTION &nbsp;&nbsp; MENU</h1>";
echo "<ul>";
echo "<li><a href=\"?x=8\">Expatriate Data</a></li><br/>";
echo "<li><a href=\"?x=1\">HR & Other License Document</a></li><br/>";
echo "<li><a href=\"?x=2\">Wood Matter License Document</a></li><br/>";
echo "<li><a href=\"?x=3\">CV. IAGO License Document</a></li><br/>";
echo "<li><a href=\"?x=4\">Company License Document</a></li><br/>";
echo "<li><a href=\"?x=10\">List Of IT Jobs</a></li><br/>";
//echo "<li><a href=\"?x=5\">Law Label USA</a></li><br/>";
//echo "<li><a href=\"?x=6\">Law Label CANADA</a></li><br/>";
//echo "<li><a href=\"?x=7\">Law Label Other</a></li><br/>";
echo "</ul>";
}elseIF(($ARSESS[0]==60)){
echo "<h1>SUGGESTION &nbsp;&nbsp; MENU</h1>";
echo "<ul>";
echo "<li><a href=\"?x=8\">Expatriate Data</a></li><br/>";
echo "<li><a href=\"?x=1\">HR & Other License Document</a></li><br/>";
echo "<li><a href=\"?x=2\">Wood Matter License Document</a></li><br/>";
echo "<li><a href=\"?x=3\">CV. IAGO License Document</a></li><br/>";
echo "<li><a href=\"?x=4\">Company License Document</a></li><br/>";
//echo "<li><a href=\"?x=5\">Law Label USA</a></li><br/>";
//echo "<li><a href=\"?x=6\">Law Label CANADA</a></li><br/>";
//echo "<li><a href=\"?x=7\">Law Label Other</a></li><br/>";
echo "</ul>";
}
}
?>
