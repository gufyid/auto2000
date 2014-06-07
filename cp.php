<?php
////
/**
 * @author gatot
 * @copyright 2009
 */

//cp.php
myConn();
$foto=mysql_fetch_array(mysql_query("select foto from t_salesman where kode='$ARSESS[1]'"));
//echo "<img src=images/cctv.gif />";
echo "<h3>Hello, ".$ARSESS[3]."</h3>";
//echo "<img src=img_salesman/$foto[foto] width=60>";
echo "<p>Last visit: ".date('d-M-Y  H:i',$ARSESS[6])."</p>";
//echo "<p>From: ".$ARSESS[8]."</p>";
echo "Best View in Firefox <img src=images/firefox.jpg width=30>";



?>