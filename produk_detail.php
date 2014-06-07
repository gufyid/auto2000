<?php

/**
 * @author Mr G
 * @copyright 2010
 */

// user_add.php
	myConn();
	$qe = mysql_query("SELECT * FROM t_produk WHERE id='$_GET[eid]'");
	mysql_close();
	$ae = mysql_fetch_array($qe);
	
	if($ae['foto']==""){
		$img = "default.jpg";
	} else {
		if(!file_exists("img_produk/$ae[foto]")){
		    $img = "default.jpg";	
		} else {
			$img = "$ae[foto]";
		}
	}
	///
?>
<div id="boxy">
<h4>Data produk</h4>
<div id="ki"><img src="<?php echo "./img_produk/$img";?>" width="120" style="margin-bottom: 10px"/></div>
<div id="ka">
<h3><?php echo "$ae[nama]";?></h3>
Kode: <?php echo "$ae[kode]";?><br />
</div>
<div id="divider">&nbsp;</div>
<div id="ki">Nama</div>
<div id="ka"><?php echo "$ae[nama]";?></div>
<div id="divider"></div>
<div id="ki">tipe</div>
<div id="ka"><?php echo "$ae[tipe]";?></div>

<h2>&nbsp;      </h2>
</div>
<?php
echo "<a href=\"./?c=$_GET[c]&amp;sub=$_GET[sub]&action=produk\"\"><b><<< Kembali</b></a>";

?>

