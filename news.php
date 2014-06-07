<?php
myconn();
$q=mysql_query("select * from t_news order by id desc limit 3");
while($dtq=mysql_fetch_array($q)){
echo "<b><font color=blue>$dtq[judul]</font></b><br/><br/>";
//echo "$dtq[isi	]<br/>";
$isi_berita = nl2br($dtq[isi]); // membuat paragraf pada isi berita
   $isi = substr($isi_berita,0,60); // ambil sebanyak 300 karakter
//   $isi = substr($isi_berita,0,strpos($isi," ")); // potong per spasi kalimat
 echo "$isi ... <a href='?c=detailberita&id=$dtq[id]'>Selengkapnya</a>
         <br /><hr color=#e0cb91 noshade=noshade />";
}

/*
$terkini= mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 4");		 
while($t=mysql_fetch_array($terkini)){
   echo "$t[hari], $t[tanggal] - $t[jam] WIB";
   echo "<h3><a href=?module=detailberita&id=$t[id_berita]>$t[judul]</a></h3>";
   echo "<img src='foto_berita/small_$t[gambar]' width=110 border=0 align=left hspace=10>";

   // Tampilkan hanya sebagian isi berita
   $isi_berita = nl2br($t[isi_berita]); // membuat paragraf pada isi berita
   $isi = substr($isi_berita,0,300); // ambil sebanyak 300 karakter
   $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

   echo "$isi ... <a href='?module=detailberita&id=$t[id_berita]'>Selengkapnya</a>
         <br /><hr color=#e0cb91 noshade=noshade />";
}
*/
?>