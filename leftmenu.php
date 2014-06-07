<?php

if(!isset($_GET['c'])||$_GET['c']==""){
	echo "<div id=\"filler\"></div>";
} else {
	if(!getACLOne($_GET['c'])){
		echo $ACLID;
	
		echo "<div id=\"filler\"></div>";
	} else {

	/////////////////////////////////////////////////////////////
		myConn();
		$qm2 = mysql_query("SELECT * FROM acl WHERE acl_level=2 AND acl_parent_id=$ACLID
		AND acl_status=1 ORDER BY acl_order ASC") or die(mysql_error());
		$nm2 = mysql_numrows($qm2);

   echo "<div class=\"sidebarmenu\">";
   /////////////////////////////////////////////////////////////////
   echo "<ul id=\"sidebarmenu1\">";
   /////////////////////////////////////////////////////////////////
   for($im2=0;$im2<$nm2;$im2++){
		    $am2 = mysql_fetch_array($qm2);
		    $zm = $im2 + 1;
      if(amIAuth($am2['acl_id'],$ARSESS[0])){
      ////////////////////////////////////////////////////////////////
      echo "<li><a href=\"./?c=$_GET[c]&sub=$am2[acl_code]\">$am2[acl_name]</a>"; //menu level 2
      $qm3 = mysql_query("SELECT * FROM acl WHERE acl_level=3 AND acl_parent_id=$am2[acl_id]
      AND acl_status=1 ORDER BY acl_order ASC") or die(mysql_error());
	  $nm3=mysql_numrows($qm3);
	  if($nm3<=0){

	  } else {
		echo "<ul>";
		for($im3=0;$im3<$nm3;$im3++){
		   $am3=mysql_fetch_array($qm3);
		   if(amIAuth($am3['acl_id'],$ARSESS[0])){
		   echo "<li><a href=\"./?c=$_GET[c]&sub=$am2[acl_code]&action=$am3[acl_code]\">
		   &nbsp;&nbsp;$am3[acl_name]</a></li>"; //menu level 3
		   }
		}
		
	echo "</ul>";
	  }
	  
      echo "</li>";
      ////////////////////////////////////////////////////////////////
      }
	}
   /////////////////////////////////////////////////////////////////
   echo "</ul>";
   ////////////////////////////////////////////////////////////////
   echo "</div>";

    /////////////////////////////////////////////////////////////
    }
	}
?>
<!--
<div class="sidebarmenu">
<ul id="sidebarmenu1">
<li><a href="#">Item 1</a></li>
<li><a href="#">Item 2</a></li>
<li><a href="#">Folder 1</a>
  <ul>
  <li><a href="#">Sub Item 1.1</a></li>
  <li><a href="#">Sub Item 1.2</a></li>
  </ul>
</li>
<li><a href="#">Item 3</a></li>

<li><a href="#">Folder 2</a>
  <ul>
  <li><a href="#">Sub Item 2.1</a></li>
  <li><a href="#">Folder 2.1</a>
    <ul>
    <li><a href="#">Sub Item 2.1.1</a></li>
    <li><a href="#">Sub Item 2.1.2</a></li>
    <li><a href="#">Sub Item 2.1.3</a></li>
    <li><a href="#">Sub Item 2.1.4</a></li>
    </ul>
  </li>
</ul>
</li>
<li><a href="#">Item 4</a></li>
</ul>
</div>

//-->

<?


?>


