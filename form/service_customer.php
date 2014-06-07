<html>
<head>
<title></title>
<style>
table, td{
	font:90% Arial, Helvetica, sans-serif; 
}
table{width:100%;border-collapse:collapse;margin:1em 0;}
th{text-align:center;padding:.5em;border:1px solid #fff;}
th, td{text-align:left;padding:.5em;border:1px solid #fff;}
th{background:#328aa4 url(../images/tr_back.gif) repeat-x;color:#fff;}
td{background:#e5f1f4;}

/* tablecloth styles */

tr.even td{background:#e5f1f4;}
tr.odd td{background:#f8fbfc;}

th.over, tr.even th.over, tr.odd th.over{background:#4a98af;}
th.down, tr.even th.down, tr.odd th.down{background:#bce774;}
th.selected, tr.even th.selected, tr.odd th.selected{}

td.over, tr.even td.over, tr.odd td.over{background:#ecfbd4;}
td.down, tr.even td.down, tr.odd td.down{background:#bce774;color:#fff;}
td.selected, tr.even td.selected, tr.odd td.selected{background:#bce774;color:#555;}

/* use this if you want to apply different styleing to empty table cells*/
td.empty, tr.odd td.empty, tr.even td.empty{background:#fff;}
</style>
</head>
<body>
<div id="tabs-4">
<input type="submit" name="btx2" value="Tampilkan" onclick="process_service_customer()">
<input type="hidden" id="adminh" value="<?php echo $ARSESS[0];?>">
<input type="hidden" id="spvh" value="<?php echo $ARSESS[1];?>">
<div id="hasil_service_customer"><center><img src="images/loader.gif"></div>
</div>
</body>
</html>
