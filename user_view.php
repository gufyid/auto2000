<?php

/**
 * @author Andy Garna
 * @copyright 2009
 */

//user_view.php
myConn();
$quv = mysql_query("SELECT * FROM user WHERE usr_class<>1") or die(mysql_error());
mysql_close();
$nuv = mysql_numrows($quv);
if($nuv<=0){
	echo "<h2>No User on database</h2>";
} else {
?>
<link href="./styles/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="./libs/tablecloth.js"></script>

<div id="boxy">
<?php
getLevelTwoTitle($ACLID,$_GET['sub']);
echo "<h3>$LV2TITLE</h3>";
?>
<table cellspacing="0" cellpadding="0">
	<tr>
		<th>Username</th>
		<th>Fullname</th>
		<th>Mobile</th>
		<th>Email</th>
		<th>Access Level</th>
		<th>Tools</th>
	</tr>
<?php
   for($iuv=0;$iuv<$nuv;$iuv++){
   	  $auv = mysql_fetch_array($quv);
   	  $view = "<tr>";
	  $view.= "<td>";
	  $view.= $auv['usr_uname'];
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= ucwords($auv['usr_fname']);
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= $auv['usr_mobile'];
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= $auv['usr_email'];
	  $view.= "</td>";
	  $view.= "<td>";
	  switch($auv['usr_class']){
	  	case 2:
	  	$view.= "Admin";
	  	break;
	  	case 3:
	  	$view.= "Supervisor Level";
	  	break;
	  	case 4:
	  	$view.= "User Level";
	  	break;
	  	case 5:
	  	$view.= "Client";
	  	break;
	  }
	  $view.= "</td>";
	  $view.= "<td>";
	  $view.= "<a href='./?c=user&sub=view&action=access&id={$auv['usr_id']}'><img src=\"./images/user-32.png\" alt='Set Access' title='Set Access' /></a>";
	  $view.= "</td>";
   	  $view.= "</tr>";
   	  //
   	  echo $view;
   }
?>

</table>
</div>
<?php
}
?>
