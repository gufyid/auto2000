<script type="text/javascript" src="./libs/jquery-1.8.2.js"></script>
<script src="./libs/highcharts.js"></script>
<script src="./libs/exporting.js"></script>
<?php
echo "<center><h1>S T A T I S T I K &nbsp;&nbsp; S Y S T E M</h1></center>";
myconn();
$dino=date("Y-m-d");

echo "<link type=\"text/css\" 		href=\"./libs/development-bundle/themes/hot-sneaks/ui.all.css\" rel=\"stylesheet\" />"; 
echo "<script type=\"text/javascript\" src=\"./libs/development-bundle/ui/ui.core.js\"></script>";
echo  "<script type=\"text/javascript\" src=\"./libs/development-bundle/ui/ui.accordion.js\"></script>";
echo  "<script type=\"text/javascript\"> 
      $(document).ready(function(){
	      $('#isi').accordion();
	    });
	</script> ";
echo "<style type=\"text/css\">
	  #panel { height:10px; width:400px; } 
	</style>";


if($ARSESS[8]=='2'){ //Jika yang login administrator
$tot_salesman=mysql_fetch_array(mysql_query("select count(*) as jum from t_salesman"));
$tot_supervisor=mysql_fetch_array(mysql_query("select count(*) as jum from t_supervisor"));
$tot_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer"));

echo "<div id='isi'>";
echo "<h2><a href=\"#\">Data System</a></h2>";

echo "<div>";

echo "<div style=float:left;width:300px>";
echo "<ul>";
echo "<li><h3>Jumlah Salesman : $tot_salesman[jum] Orang</h3></li>";
echo "<li><h3>Jumlah Supervisor : $tot_supervisor[jum] Orang</h3></li>";
echo "<li><h3>Jumlah Database : $tot_customer[jum] Customer</h3></li>";
echo "</ul>";
echo "</div>";

echo "<div style=float:left;width:450px>";
include "grafik_admin.php";
echo "</div>";


echo "<div style=float:left;width:500px;top-padding:10px;padding-top=12px>";
include "grafik/komposisi_segmen_home.php";
echo "</div>";

echo "<div style=float:left;width:400px>";
include "grafik/komposisi_tipe_home.php";
echo "</div>";


echo "</div>";
echo "<h2><a href=\"#\">Coverage Area Auto 2000 Cabang Waru</a></h2>";
echo "<div>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./styles/default.css\" />";
echo "<div id=\"map-container\"></div>";
echo "<script src=\"./libs/kinetic-v5.1.0.min.js\"></script>";
echo "<script defer=\"defer\" src=\"./libs/map.js\"></script>";
echo "<div id=legend>";
echo "<h4><b>Jumlah Customer Per Wilayah</b></h4>";
echo "<div>Total Customer&nbsp;=>&nbsp;<b><span id=global-legend></span></b></div><br />";
echo "<div>Surabaya Utara&nbsp;=>&nbsp;<b><span id=surabayaUtara-legend></span></b></div><br />";
echo "<div>Surabaya Barat&nbsp;=>&nbsp<b><span id=surabayaBarat-legend></span></b></div><br />";
echo "<div>Surabaya Timur&nbsp;=>&nbsp<b><span id=surabayaTimur-legend></span></b></div><br />";
echo "<div>Surabaya Selatan&nbsp;=>&nbsp<b><span id=surabayaSelatan-legend></span></b></div><br />";
echo "<div>Sidoarjo&nbsp;=>&nbsp<b><span id=sidoarjo-legend></span></b></div><br />";
echo "<div>Gresik&nbsp;=>&nbsp<b><span id=gresik-legend></span></b></div><br />";
echo "<div>Mojokerto&nbsp;=>&nbsp<b><span id=mojokerto-legend></span></b></div><br />";
echo "<div>Daerah Lain&nbsp;=>&nbsp<b><span id=other-legend></span></b></div><br />";


echo "</div>";
echo "</div>";
/*
echo "<h2><a href=\"#\">Grafik Jumlah 7Step Vs Patern</a></h2>";
echo "<div>";
include "grafik_admin.php";
echo "</div>";
*/

echo "</div>";


}elseif($ARSESS[8]=='3'){ //Jika yang login Supervisor
$tot_salesman=mysql_fetch_array(mysql_query("select count(*) as jum from t_salesman where spv='$ARSESS[1]'"));
$tot_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer a
left join t_salesman b on b.kode=a.salesman
left join t_supervisor c on c.kode=b.spv where c.kode='$ARSESS[1]'"));
//$tot_kunjungan=mysql_fetch_array(mysql_query("select count(*) as jum from t_kunjungan a
//left join t_salesman b on b.kode=a.salesman where b.spv='$ARSESS[1]'
//"));
$q=mysql_query("select a.tgl_lahir,c.nama as kecamatan,a.nama as nama_toko,b.nama from t_customer a
				left join t_salesman b on b.kode=a.salesman
				left join t_kecamatan c on c.id=a.kecamatan where b.spv='$ARSESS[1]'");

//echo "<div id='panel'>";
echo "<div id='isi'>";

echo "<h2><a href=\"#\">Data System</a></h2>";
echo "<div>";
echo "<ul>";
echo "<li><h3>Jumlah Salesman : $tot_salesman[jum] Orang</h3></li>";
echo "<li><h3>Jumlah Database : $tot_customer[jum] Customer</h3></li>";
//echo "<li><h3>Jumlah Visit : $tot_kunjungan[jum]</h3></li>";
echo "<li><h3>Customer Yang Ultah: </h3></li>";
while($dtq=mysql_fetch_array($q)){
$tgl=explode("-",$dtq['tgl_lahir']);
$tgl_lahir=date("Y")."-".$tgl[1]."-".$tgl[2];
$selisih=(strtotime($tgl_lahir)-strtotime($dino))/(60*60*24);
if($selisih>=1 && $selisih<=2){

echo "<div align=left><blink><font style=color:red size=2>-".strtoupper($dtq['nama_toko'])."&nbsp;($tgl_lahir)&nbsp;$dtq[kecamatan]&nbsp;==>Salesman&nbsp;:&nbsp;$dtq[nama]</font></blink><br /></div>";
}

}
echo "</ul>";
echo "</div>";
echo "<h2><a href=\"#\">Coverage Area</a></h2>";
echo "<div>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./styles/default.css\" />";
echo "<div id=\"map-container\"></div>";
echo "<script src=\"./libs/kinetic-v5.1.0.min.js\"></script>";
echo "<script>";
echo "var spv='$ARSESS[1]'";
echo "</script>";
echo "<script defer=\"defer\" src=\"./libs/map_spv.js\"></script>";
echo "<div id=legend>";
echo "<h4><b>Jumlah Customer Per Wilayah</b></h4>";
echo "<div>Total Customer&nbsp;=>&nbsp;<b><span id=global-legend></span></b></div><br />";
echo "<div>Surabaya Utara&nbsp;=>&nbsp;<b><span id=surabayaUtara-legend></span></b></div><br />";
echo "<div>Surabaya Barat&nbsp;=>&nbsp<b><span id=surabayaBarat-legend></span></b></div><br />";
echo "<div>Surabaya Timur&nbsp;=>&nbsp<b><span id=surabayaTimur-legend></span></b></div><br />";
echo "<div>Surabaya Selatan&nbsp;=>&nbsp<b><span id=surabayaSelatan-legend></span></b></div><br />";
echo "<div>Sidoarjo&nbsp;=>&nbsp<b><span id=sidoarjo-legend></span></b></div><br />";
echo "<div>Gresik&nbsp;=>&nbsp<b><span id=gresik-legend></span></b></div><br />";
echo "<div>Mojokerto&nbsp;=>&nbsp<b><span id=mojokerto-legend></span></b></div><br />";
echo "<div>Daerah Lain&nbsp;=>&nbsp<b><span id=other-legend></span></b></div><br />";
echo "</div>";
echo "</div>";
echo "<h2><a href=\"#\">Grafik 7Step & Data Kapasitas Customer Per Supervisor</a></h2>";
echo "<div>";
echo "<table>";
echo "<tr><td>";
include "grafik_spv.php";
echo "</td>";
echo "<td>";
include "grafik/kapasitas_customer_home.php";
echo "</td></tr></table>";
echo "</div>";

echo "<h2><a href=\"#\">Grafik Komposisi Tipe Per Supervisor</a></h2>";
echo "<div>";
include "grafik/komposisi_tipe_home.php";
echo "</div>";

echo "</div>";//akhir div isi
//echo "</div>";
}elseif($ARSESS[8]=='4'){
$cek=mysql_query("select a.id_kunjungan,a.komentar,a.tgl_komentar from t_komentar a
	  left join t_kunjungan b on b.id=a.id_kunjungan where b.salesman='$ARSESS[1]'
	  and datediff(curdate(),a.tgl_komentar)<=7");
	  $ncek=mysql_num_rows($cek);

$tot_customer=mysql_fetch_array(mysql_query("select count(*) as jum from t_customer where salesman='$ARSESS[1]'"));
$q=mysql_query("select a.tgl_lahir,c.nama as kecamatan,a.nama as nama_toko,b.nama as salesman from t_customer a
				left join t_salesman b on b.kode=a.salesman
				left join t_kecamatan c on c.id=a.kecamatan where b.kode='$ARSESS[1]' and a.tgl_lahir!='0000-00-00'");
	  

echo "<div id='isi'>";
echo "<h2><a href=\"#\">Data System</a></h2>";
echo "<div>";
echo "<ul>";
echo "<li><h3>Jumlah Database : $tot_customer[jum] Customer</h3></li>";
echo "<li><h3>Customer Yang Ultah: </h3></li>";
while($dtq=mysql_fetch_array($q)){
$tgl=explode("-",$dtq['tgl_lahir']);
$tgl_lahir=date("Y")."-".$tgl[1]."-".$tgl[2];
$selisih=(strtotime($tgl_lahir)-strtotime($dino))/(60*60*24);
if($selisih>=1 && $selisih<=2){
echo "<div align=left><blink><font style=color:red size=2>-".strtoupper($dtq['nama_toko'])."&nbsp;($tgl_lahir)&nbsp;$dtq[kecamatan]&nbsp;==>Salesman&nbsp;:&nbsp;$dtq[salesman]</font></blink><br /></div>";
}
}
echo "</ul>";
echo "<div style=float:left;width:450px>";
include "grafik_salesman.php";
echo "</div>";

echo "</div>";


if($ncek>0){
        
echo "<h2><a href=\"#\">Komentar Supervisor</a></h2>";
echo "<div>";
echo "<link href=\"./styles/tablecloth.css\" rel=\"stylesheet\" type=\"text/css\"/>";
$view="";
$view.="<table>";
$view.="<tr>";
$view.="<th>No</th>";
$view.="<th>Customer</th>";
$view.="<th>Tgl Visit</th>";
$view.="<th>Tgl Komentar</th>";
$view.="<th>Komentar</th>";
$view.="</tr>";
$no=0;
while($dtq=mysql_fetch_array($cek)){
$no++;
$visit=mysql_fetch_array(mysql_query("select a.tgl,b.nama from t_kunjungan a
									  left join t_customer b on b.kode=a.customer
									  where a.id='$dtq[id_kunjungan]'"));
$view.="<tr>";
$view.="<td>$no</td>";
$view.="<td>$visit[nama]</td>";
$view.="<td>$visit[tgl]</td>";
$view.="<td>$dtq[tgl_komentar]</td>";
$view.="<td>$dtq[komentar]</td>";
$view.="</tr>";
}
$view.="</table>";
echo  $view;
echo "</div>";
}
/*
echo "<h2><a href=\"#\">Grafik 7Step Vs Target</a></h2>";
echo "<div>";
include "grafik_salesman.php";
echo "</div>";
*/
echo "</div>";//akhir div isi



}
?>
