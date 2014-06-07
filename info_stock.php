<?php
myconn();
$q=mysql_query("select * from t_stock order by id");
echo "<marquee behavior=alternate scrollamount= 1>";
echo "<font size=+0.1 style=color:blue;size:10px;>";
echo "Update Stock => ";
while($dtq=mysql_fetch_array($q)){
$produk=mysql_fetch_array(mysql_query("select nama from t_produk where id='$dtq[product]'"));
echo "$produk[nama]&nbsp;$dtq[stock]&nbsp;Unit&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "</font>";
echo "</marquee>";
?>