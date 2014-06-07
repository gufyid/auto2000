<?php

/**
 * @author gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
//getLevelThreeTitle($ACL2ID,$_GET['action']);
echo "<h3>$LV2TITLE</h3>";
myconn();
?>
<link rel="stylesheet" href="./styles/ui.datepicker.css" type="text/css" media="screen" title="core css file" charset="utf-8" />
<script type="text/javascript" src="./ajax/ajax_process.js"></script>
<script type="text/javascript" src="./libs/livevalidation.js"></script>
<script src="./libs/jquery-1.8.2.js" type="text/javascript" charset="utf-8"></script>	
<script src="./libs/jquery-ui.js"></script>
<script src="./libs/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>	
<link rel="stylesheet" type="text/css" href="./jquery.fixheadertable/jquery-ui/css/hot-sneaks/jquery-ui-1.8.4.custom.css"/>
<link rel="stylesheet" type="text/css" href="./styles/tablecloth.css"/>
<script type="text/javascript" charset="utf-8">
	jQuery(function($){
	$("#tgl1").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	$("#tgl2").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
		$("#tgl3").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
		$("#tgl4").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	$("#tgl5").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	$("#tgl6").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	$("#tgl7").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	$("#tgl8").datepicker(
	{
		dateFormat: 'dd/mm/yy',
		yearRange: '-55:-0' 
	}
	);
	//
	//
	$( "#tabs" ).tabs();
	//
	$( "#tabs1" ).tabs();
	//
		$( "#tabs2" ).tabs();
//
		$( "#tabs_mesin" ).tabs();
//
		$( "#tabs_wip" ).tabs();
//
		$( "#tabs_fg" ).tabs();

	//
	});
	//
	
	//
</script>

<script type="text/javascript">
function pilihanmu(){
	var val = 0;
	for( i = 0; i < document.form1.pilihan.length; i++ ){
		if( document.form1.pilihan[i].checked == true ){
			val = document.form1.pilihan[i].value;
			if(val=='1'){
				document.form1.bln.disabled = true;	
				document.form1.thn.disabled = true;	
				document.form1.tgl.disabled = false;
							
			}else if(val=='2'){
				document.form1.bln.disabled = false;	
				document.form1.thn.disabled = false;	
				document.form1.tgl.disabled = true;
			}else{
		document.form1.bln.disabled = true;	
				document.form1.thn.disabled = true;	
				document.form1.tgl.disabled = true;
			}
		}
	}
}
</script>
<br /><br /><br /><br />
<!-- Mulai Tab Ajax -->
<div id="tabs">
<ul>
<li><a href="#tabs-1">Aktivitas Salesman</a></li>
<li><a href="#tabs-2">Pencapaian Networking Salesman</a></li>
</ul>
<?php
include ("form/aktivitas_salesman.php");
include ("form/pencapaian_networking.php");
?>
</div>


