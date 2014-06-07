<?php
$id=$_GET['id'];
myconn();
$q=mysql_fetch_array(mysql_query("select * from t_news where id='$id'"));
$tgl=explode("-",$q['tgl']);
$tgl=mktime(0,0,0,$tgl[1],$tgl[2],$tgl[0]);
$dino=date("d-M-Y",$tgl);

echo "<h2><center><font color=blue>$q[judul]</font></center></h2>";
echo "$dino<br/>";
echo "Posted By $q[pelaksana]<br/><br/>";
$isi=nl2br($q['isi']);
echo "$isi...";

?>