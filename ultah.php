<html>
  <head>
    <link rel="stylesheet" type="text/css" href="development-bundle/themes/hot-sneaks/ui.all.css">
    <script type="text/javascript" src="development-bundle/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="development-bundle/ui/ui.core.js"></script>
    <script type="text/javascript" src="development-bundle/ui/ui.dialog.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#kotakdialog").dialog({
          autoOpen: false
        });
      
        $("#buka").click(function() {
            $("#kotakdialog").dialog('open');
          }
        );
      });
    </script>
  </head>
    <body style="font-size:95%;">
    <div id="kotakdialog" title="Pesan Hari Ini">Jangan pernah mengukur tingginya gunung sebelum Anda mencapai puncaknya. Karena begitu ada di puncak, Anda akan melihat betapa rendahnya gunung itu.</div>
    <input type="submit" id="buka" value="Buka Kotak Dialog">
  </body>
</html>
