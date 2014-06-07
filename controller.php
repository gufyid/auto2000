<?php

/**
 * @author gatot
 * @copyright 2009
 */


/////// AUTH HERE ///////////////////

   if(!isAuth(1,$_GET['c'],$ARSESS[0])){
   	
   	include("./includes/403.php");
   	
   } else {
   	
   	if(!isset($_GET['sub'])){
   		include("./includes/home_$_GET[c].php");
//   		include("./includes/home.php");
   	} else {
   		
	    ///
		if(!isset($_GET['action'])||$_GET['action']==""){
		getACLOne($_GET['c']);
   		if(!isAuth2(2,$_GET['sub'],$ARSESS[0],$ACLID)){
   			include("./includes/403.php");
   		} else {
   			if(!file_exists("./includes/$_GET[c]_$_GET[sub].php")){
   				//include("./includes/404.php");
				include("./includes/home.php");
   			} else {
   				include("./includes/$_GET[c]_$_GET[sub].php");
   			}
   		}
   		} else {
   			getACLOne($_GET['c']);
   			getACLTwo($ACLID,$_GET['sub']);
   			//echo "LV1: ".$ACLID."<br/>";
   			//echo "LV2: ".$ACL2ID;
		    
		    if(!isAuth2(3,$_GET['action'],$ARSESS[0],$ACL2ID)){
   				include("./includes/403.php");
   			} else {
   				if(!file_exists("./includes/$_GET[c]_$_GET[sub]_$_GET[action].php")){
   					include("./includes/404.php");
   				} else {
   					include("./includes/$_GET[c]_$_GET[sub]_$_GET[action].php");
   				}
   			}
   			
   			
   			
   		}
   		////
   	}
    	
   }


?>
