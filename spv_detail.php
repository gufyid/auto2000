<?php

/**
 * @author Mr G
 * @copyright 2010
 */

// user_add.php
	myConn();
	$qe = mysql_query("SELECT * FROM t_supervisor WHERE id='$_GET[eid]'");
	mysql_close();
	$ae = mysql_fetch_array($qe);
	
	if($ae['foto']==""){
		$img = "default.jpg";
	} else {
		if(!file_exists("img_supervisor/$ae[foto]")){
		    $img = "default.jpg";	
		} else {
			$img = "$ae[foto]";
		}
	}
	///
?>
<div id="boxy">
<h4>Data Supervisor</h4>
<div id="ki"><img src="<?php echo "./img_supervisor/$img";?>" width="120" style="margin-bottom: 10px"/></div>
<div id="ka">
<h3><?php echo "$ae[nama]";?></h3>
NIP: <?php echo "$ae[kode]";?><br />
</div>
<div id="divider">&nbsp;</div>
<div id="ki">Nama</div>
<div id="ka"><?php echo "$ae[nama]";?></div>
<div id="divider"></div>
<div id="ki">Alamat</div>
<div id="ka"><?php echo "$ae[alamat]";?></div>
<div id="divider"></div>
<div id="ki">Telepon</div>
<div id="ka"><?php echo "$ae[telp]";?></div>

<h2>&nbsp;      </h2>
</div>
<?php
echo "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=spv\"\"><b><<< Kembali</b></a>";

?>

