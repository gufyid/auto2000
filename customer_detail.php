<?php

/**
 * @author Mr G
 * @copyright 2010
 */

// user_add.php
	myConn();
	$qe = mysql_query("SELECT * FROM t_customer WHERE kode='$_GET[eid]'");
	$ae = mysql_fetch_array($qe);
	$kecamatan=mysql_fetch_array(mysql_query("select * from t_kecamatan where id='$ae[kecamatan]'"));
	$jusaha=mysql_fetch_array(mysql_query("select * from t_jenis_usaha where id='$ae[jenis_usaha]'"));
	$bdusaha=mysql_fetch_array(mysql_query("select * from t_bidang_usaha where id='$ae[bidang_usaha]'"));
	$badanusaha=mysql_fetch_array(mysql_query("select * from t_badan_usaha where id='$ae[jenis_badan_usaha]'"));
	$salesman=mysql_fetch_array(mysql_query("select * from t_salesman where kode='$ae[salesman]'"));
	mysql_close();
	if($ae['foto']==""){
		$img = "default.jpg";
	} else {
		if(!file_exists("img_customer/$ae[foto]")){
		    $img = "default.jpg";	
		} else {
			$img = "$ae[foto]";
		}
	}
	///
?>
<div id="boxy">
<h4>Data Customer</h4>
<div id="ki"><img src="<?php echo "./img_customer/$img";?>" width="120" style="margin-bottom: 10px"/></div>
<div id="ka">
<h3><?php echo "$ae[nama]";?></h3>
Kode: <?php echo "$ae[kode]";?><br />
</div>
<div id="divider">&nbsp;</div>
<div id="ki">Nama</div>
<div id="ka"><?php echo "$ae[nama]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Alamat</div>
<div id="ka"><?php echo "$ae[alamat]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Contact Person</div>
<div id="ka"><?php echo "$ae[contact]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Telepon</div>
<div id="ka"><?php echo "$ae[telp]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Kecamatan</div>
<div id="ka"><?php echo "$kecamatan[nama]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Tempat/Tgl Lahir</div>
<div id="ka"><?php echo "$ae[tempat_lahir]/$ae[tgl_lahir]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Jenis Usaha</div>
<div id="ka"><?php echo "$jusaha[nama]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Bidang Usaha</div>
<div id="ka"><?php echo "$bdusaha[nama]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Jasa/Produksi</div>
<div id="ka"><?php if ($ae['jasa_produksi']=='J'){echo "Jasa";}else{ echo "Produksi";}?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Prospect/First/Cust</div>
<div id="ka"><?php if($ae['prospect_first_cust']=='P'){echo "Prospect";}elseif($ae['prospect_first_cust']=='F'){echo "First";}else{echo "Cust";}?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Tipe</div>
<div id="ka">
<?php 
myconn();
$tipe=mysql_fetch_array(mysql_query("select nama from t_produk where id='$ae[tipe]'"));
echo "$tipe[nama]";
?>
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Total UIO</div>
<div id="ka">
<?php 
myconn();
$uio=mysql_fetch_array(mysql_query("select nama from t_uio where id='$ae[uio]'"));
echo "$uio[nama]";
?>
</div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Segmen</div>
<div id="ka"><?php echo $ae['segmen'];?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Decision Maker</div>
<div id="ka"><?php if($ae['decision']=='1'){echo "Owner";}else{ echo "Purchasing";}?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Jenis Badan Usaha</div>
<div id="ka"><?php echo "$badanusaha[nama]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Omzet</div>
<?php
myConn();
$q=mysql_fetch_array(mysql_query("select * from t_omzet where id='$ae[omzet]'"));
?>
<div id="ka"><?php echo $q['keterangan'];?></div>
<div id="divider"></div>
<div id="divider"></div>
<?php
myConn();
$q=mysql_fetch_array(mysql_query("select * from t_lama_usaha where id='$ae[lama_usaha]'"));
?>
<div id="ki">Lama Usaha</div>
<div id="ka"><?php echo "$q[keterangan]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Lokasi Usaha</div>
<div id="ka"><?php echo "$ae[lokasi_usaha]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Score</div>
<div id="ka"><?php echo "$ae[score]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Networking</div>
<div id="ka"><?php echo "$ae[networking]";?></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">Salesman</div>
<div id="ka"><?php echo "$salesman[nama]";?></div>

<h2>&nbsp;      </h2>
</div>
<?php
echo "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=cust\"\"><b><<< Kembali</b></a>";

?>

