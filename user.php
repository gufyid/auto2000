<?php

/**
 * @author Andy Garna
 * @copyright 2009
 */


/////// AUTH HERE ///////////////////

   if(!isAuth(1,$_GET['c'],$ARSESS[0])){
   	
   	include("./includes/403.php");
   	
   } else {
   	
   	if(!isset($_GET['sub'])){
   		include("./includes/home_$_GET[c].php");
   	} else {
   		if(!isAuth(2,$_GET['sub'],$ARSESS[0])){
   			include("./includes/403.php");
   		} else {
   			if(!file_exists("./includes/$_GET[c]_$_GET[sub].php")){
   				include("./includes/404.php");
   			} else {
   				include("./includes/$_GET[c]_$_GET[sub].php");
   			}
   		}
   		
   	}
    	
   }


?>