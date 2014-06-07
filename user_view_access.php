<?php

    myConn();

    function redirect()
    {
        echo '<script type="text/javascript">window.location.href = "./?c=user&sub=view";</script>';
        exit;
    }

    if (!isset($_GET['id'])) {
        redirect();
    }

    $idUser = $_GET['id'];

    $rsUser = mysql_query("SELECT * FROM user WHERE usr_id = {$idUser}");

    if (mysql_num_rows($rsUser) != 1) {
        redirect();
    }

    $user = mysql_fetch_assoc($rsUser);

    if (isset($_POST['acl'])) {
        $accessAvailable = array();
        $accessRequested = $_POST['acl'];

        $accessAdded = array();
        $accessUpdated = array();

        foreach ($accessRequested as $key => $value) {
            $accessRequested[$key] = true;
        }
        ksort($accessRequested);

        $rsAccessAvailableList = mysql_query("SELECT access_id, acl_id, access FROM access WHERE usr_id = {$idUser} ORDER BY access_id ASC");
        while ($row = mysql_fetch_assoc($rsAccessAvailableList)) {
            $accessAvailable[$row['acl_id']] = $row['access'] == 0 ? false : true;
        }
        ksort($accessAvailable);

        foreach ($accessAvailable as $acl => $value) {
            if (isset($accessRequested[$acl]) && $value == false) {
                    $accessUpdated[$acl] = true;
            } elseif (!isset($accessRequested[$acl]) && $value == true) {
                $accessUpdated[$acl] = false;
            }
        }

        foreach ($accessRequested as $acl => $value) {
            if (!isset($accessAvailable[$acl])) {
                $accessAdded[$acl] = true;
            }
        }

        if (!empty($accessAdded)) {
            $queryInsert = 'INSERT INTO access (acl_id, usr_id, access) VALUES ';
            foreach ($accessAdded as $acl => $access) {
                $queryInsert .= '(' . $acl . ', ' . $idUser . ', ' . $access  . ')';

                end($accessAdded);
                if ($acl != key($accessAdded)) {
                    $queryInsert .= ', ';
                }
            }

            mysql_query($queryInsert) or die('Error: ' . mysql_error());
        }

        if (!empty($accessUpdated)) {
            $queryUpdate = 'UPDATE access SET access = '
                . "(CASE acl_id ";
            foreach ($accessUpdated as $acl => $access) {
                $access = ($access) ? 'true' : 'false';
                $queryUpdate .= "WHEN {$acl} THEN {$access} ";

                end($accessUpdated);
                if ($acl != key($accessUpdated)) {
                    $queryUpdate .= ' ';
                }
            }
            $queryUpdate .= "END) "
                . "WHERE usr_id = {$idUser} "
                . 'AND acl_id IN (' . implode(', ', array_keys($accessUpdated)) . ')';

            mysql_query($queryUpdate) or die('Error: ' . mysql_error());
        }

        redirect();
    }

    $aclFirstLevel = array();
    $rsAclFirstLevel = mysql_query("SELECT * FROM acl WHERE acl_level = 1");
    while ($row = mysql_fetch_assoc($rsAclFirstLevel)) {
        $i = count($aclFirstLevel);
        $aclFirstLevel[$i]['id']   = $row['acl_id'];
        $aclFirstLevel[$i]['name'] = $row['acl_name'];
    }

    $aclSecondLevel = array();
    $rsAclSecondLevel = mysql_query("SELECT * FROM acl WHERE acl_level = 2");
    while ($row = mysql_fetch_assoc($rsAclSecondLevel)) {
        $i = count($aclSecondLevel[$row['acl_parent_id']]);
        $aclSecondLevel[$row['acl_parent_id']][$i]['id']   = $row['acl_id'];
        $aclSecondLevel[$row['acl_parent_id']][$i]['name'] = $row['acl_name'];
    }

    $aclThirdLevel = array();
    $rsAclThirdLevel = mysql_query("SELECT * FROM acl WHERE acl_level = 3");
    while ($row = mysql_fetch_assoc($rsAclThirdLevel)) {
        $i = count($aclThirdLevel[$row['acl_parent_id']]);
        $aclThirdLevel[$row['acl_parent_id']][$i]['id']     = $row['acl_id'];
        $aclThirdLevel[$row['acl_parent_id']][$i]['name']   = $row['acl_name'];
    }

    $userAccess = array();
    $rsUserAccess = mysql_query("SELECT * FROM access WHERE usr_id = {$idUser} ORDER BY acl_id ASC");
    while ($row = mysql_fetch_assoc($rsUserAccess)) {
        $userAccess[$row['acl_id']] = $row['access'];
    }
?>

<script src="./libs/jquery-1.9.1.min.js"></script>

<style type="text/css">
html {
    -webkit-animation:safariSelectorFix infinite 1s;
}

@-webkit-keyframes safariSelectorFix {
    0% {
        zoom: 1;
    }
    100% {
        zoom: 1;
    }
}

div.collapsible {
    display:block;margin: 1em 0 0 0;
    text-decoration: none;
    border: 1px solid black;
    border-radius: 4px;
    background: #CDF;
    padding: 10px;
    cursor: pointer;
}

div.collapsible:before {
    content: "»";
}

div.collapsible.expanded {
    border-width: 1px 1px 0 1px;
    border-radius: 4px 4px 0 0;
}

div.collapsible.expanded:before {
    content: "«";
}

div.collapsible div.input {
    float: right;
}

div.collapsible + div {
    display: none;
}

div.collapsible.expanded + div {
    display: block;
    border-width: 0 1px 1px 1px;
    border-style: solid;
    border-radius: 0 0 4px 4px;
    border-color: black;
}

div.collapsible.expanded + div * {
    padding: 0.3em 10px 0em 10px;
}

div.collapsible.expanded + div *:first-child {
    margin-top: 0;
}

div.collapsible.expanded + div p {
    width: auto;
}

div.collapsible.expanded + div ul {
    margin: 0 0 5px 0;
    padding-right: 0;
}

div.collapsible.expanded + div ul li {
    list-style-position: inside;
    padding-right: 0;
}

div.collapsible.expanded + div ul li div.input {
    float: right;
    padding-top: 0;
}

div.collapsible.expanded div ul li:last-child::after {
    content: '' !important;
}

div.collapsible.expanded + div ul li div.input + ul {
    padding-right: 0;
}

div.collapsible.expanded + div ul li div.input + ul li {
    padding-right: 0;
}
</style>

<div id="boxy">
    <h3>User Access For <b><font color="blue"><?php echo $user['usr_fname'] ?></font></b></h3>
    <form method="post">
        <fieldset>
            <?php
                $i = 0;
                foreach ($aclFirstLevel as $aclFirst) :
                    $checked = ' ';
                    if (isset($userAccess[$aclFirst['id']]) && $userAccess[$aclFirst['id']] == true) {
                        $checked = 'checked="checked" ';
                    } else {
                        $checked =  ' ';
                    }
             ?>
            <div class="collapsible" tabindex="<?php echo $i++ ?>">
                <?php echo $aclFirst['name'] ?>
                <div class="input">
                    <input type="checkbox" name="acl[<?php echo $aclFirst['id'] ?>]" <?php echo $checked ?>/>
                </div>
            </div>
            <div>
                <?php if (isset($aclSecondLevel[$aclFirst['id']])) : ?>
                <ul>
                <?php
                    foreach ($aclSecondLevel[$aclFirst['id']] as $aclSecond) :
                        $checked = ' ';
                        if (isset($userAccess[$aclSecond['id']]) && $userAccess[$aclSecond['id']] == true) {
                            $checked =  'checked="checked" ';
                        } else {
                            $checked =  ' ';
                        }
                ?>
                    <li>
                        <?php echo $aclSecond['name'] ?>
                        <div class="input">
                            <input type="checkbox" name="acl[<?php echo $aclSecond['id']; ?>]" <?php echo $checked ?>/>
                        </div>
                        <?php if (isset($aclThirdLevel[$aclSecond['id']])) : ?>
                        <ul>
                            <?php
                                foreach ($aclThirdLevel[$aclSecond['id']] as $aclThird) :
                                    $checked = ' ';
                                    if (isset($userAccess[$aclThird['id']]) && $userAccess[$aclThird['id']] == true) {
                                        $checked =  'checked="checked" ';
                                    } else {
                                        $checked =  ' ';
                                    }
                            ?>
                            <li>
                                <?php echo $aclThird['name'] ?>
                                <div class="input">
                                    <input type="checkbox" name="acl[<?php echo $aclThird['id']; ?>]" <?php echo $checked ?>/>
                                </div>
                            </li>
                            <?php endforeach ?>
                        </ul>
                        <?php endif ?>
                    </li>
                    <?php endforeach ?>
                </ul>
                <?php endif ?>
            </div>
            <?php endforeach ?>
            <hr />
            <div>
                <input type='reset' value='Reset'>
                <input type='submit' value='Simpan' name='btx'>
            </div>
        </fieldset>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("div.collapsible").click(function(e){
            if ($(e.target).is(this)) {
                $(this).toggleClass('expanded');
            }
        });

        updateElementColor();

        $("input[type=reset]").click(function(e){
            e.preventDefault();

            $(this).closest("form").get(0).reset();
            updateElementColor();
        });

        $("div.collapsible .input input, div.collapsible + div .input input").change(function() {
            fireUpdateElementColor($(this));
        });
    });

    function updateElementColor()
    {
        $.each($("div.collapsible .input input, div.collapsible + div .input input"), function(){
            fireUpdateElementColor($(this));
        });
    }

    function fireUpdateElementColor(element)
    {
        if (element.is(":checked")) {
            element.parent().parent().css("color", "green");
        } else {
            element.parent().parent().css("color", "red");
        }
    }
</script>
