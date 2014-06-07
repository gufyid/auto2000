<?php

/**
 * @author Andy Garna
 * @copyright 2009
 */

  if(!isset($_GET['c'])||$_GET['c']==""){
  	echo "Welcome to Sales Monitoring System Auto2000 Waru";
  } else {
  	getTitle($_GET['c']);
  	echo $pageTitle;
  }

?>