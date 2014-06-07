<div id="navcontainer">
    <ul id="navlist">
        <?php
            if(! isset($_GET['c']) || $_GET['c'] == "") {
                echo "<li id=\"active\"><a href=\"./\" id=\"current\">Home</a></li>";
            } else {
                echo "<li><a href=\"./\">Home</a></li>";
            }

            myConn();

            $qxm = mysql_query("SELECT * FROM access access
                LEFT JOIN acl acl
                ON (access.acl_id = acl.acl_id)
                WHERE access.usr_id = {$ARSESS[0]}
                AND acl.acl_level = 1 and acl.acl_status= 1
                ORDER BY acl.acl_order ASC, acl.acl_id ASC");

            while ($item = mysql_fetch_assoc($qxm)) {
                if (isset($_GET['c']) && $_GET['c'] == $item['acl_code']) {
                    echo "<li id=\"active\"><a href=\"{$item['acl_link']}\" id=\"current\">{$item['acl_name']}</a></li>";
                } else {
                    echo "<li><a href=\"{$item['acl_link']}\">{$item['acl_name']}</a></li>";
                }
            }

            mysql_close();

            /* logout */
            if(isset($_SESSION['arinaSess'])){
                echo "<li><a href=\"./logout.php\">Logout</a></li>";
            }
        ?>
    </ul>
</div>