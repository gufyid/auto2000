<?php

/**
 * @author Gatot
 * @copyright 2009
 */

// user_add.php
getLevelTwoTitle($ACLID,$_GET['sub']);
echo "<h3>$LV2TITLE</h3>";

if(!isset($_POST['btx'])){


?>
<script type="text/javascript" src="./libs/livevalidation.js"></script>

<div id="boxy">
<h4>Access Credentials</h4>
<p>Please enter User credentials here</p>
<form method="post" action="#">
<fieldset>
<div id="ki">Username</div>
<!--<div id="ka"><input type="text" class="medium" name="uname" id="uname"/></div>-->
<div id="ka"><select class="medium" name="uname" id="uname"/>
<option value="" selected="selected">Pilih</option>
<?php
myConn();
$data=array();
$q=mysql_query("select kode,nama from t_salesman where kode not in (select usr_uname from user) order by id");
$q1=mysql_query("select kode,nama from t_supervisor where kode not in (select usr_uname from user) order by id");
while($dtq=mysql_fetch_array($q)){
//echo "<option value=$dtq[kode]>$dtq[nama]</option>";
 array_push($data, $dtq);
 }
 
while($dtq1=mysql_fetch_array($q1)){
//echo "<option value=$dtq[kode]>$dtq[nama]</option>";
 array_push($data, $dtq1);
 }

 foreach($data as $baris) {
echo "<option value=$baris[0]>$baris[1]</option>";

 }
?>
</select>
</div>
<div id="divider">&nbsp;</div>
<div id="ki">Password</div>
<div id="ka"><input type="password" class="medium" name="passwd1" id="passwd1"/></div>
<div id="divider"></div>
<div id="ki">Confirm Password</div>
<div id="ka"><input type="password" class="medium" name="passwd2" id="passwd2"/></div>
<!--
<div id="divider"></div>
<div id="ki">Full Name</div>
<div id="ka"><input type="text" class="medium" name="fname" id="fname"/></div>
<div id="divider"></div>
<div id="ki">Mobile</div>
<div id="ka"><input type="text" class="medium" name="mobile" id="mobile"/></div>
<div id="divider"></div>
<div id="ki">Email</div>
<div id="ka"><input type="text" class="medium" name="email" id="email"/></div>
-->
<div id="divider">&nbsp;</div>
<div id="ki">Access Level</div>
<div id="ka">
<select name="uclass">
<option value="">Select</option>
<option value="2">Administrator</option>
<option value="3">Supervisor Level</option>
<option value="4">Salesman Level</option>
<!--<option value="5">Client</option>-->
</select>
</div>
<div id="divider"></div>
<div id="ki">Activate?</div>
<div id="ka"><input type="checkbox" name="status" checked="checked"/></div>
<div id="divider"></div>
<div id="divider"></div>
<div id="ki">&nbsp;</div>
<div id="ka"><input type="submit" name="btx" value="Add"/>&nbsp;<input type="reset" value="Reset"/></div>
<div id="divider"></div>
</fieldset>
</form>
<h2>&nbsp;</h2>
</div>


<!-- Live Validation //-->
<script type="text/javascript">

var uname = new LiveValidation('uname',{onlyOnSubmit: true });
uname.add( Validate.Presence );
uname.add( Validate.Length, { minimum: 2, maximum: 14 } );
//
var pwd = new LiveValidation('passwd1');
pwd.add( Validate.Presence );
pwd.add( Validate.Length, { minimum: 8, maximum: 14 } );
//
var passwd = new LiveValidation('passwd2');
passwd.add( Validate.Presence );
passwd.add( Validate.Confirmation, { match: 'passwd1' } );
//
var fname = new LiveValidation('fname');
fname.add( Validate.Presence );
//
var mobile = new LiveValidation('mobile');
mobile.add( Validate.Presence );
mobile.add( Validate.Numericality, { minimum: 7} );
//
var email = new LiveValidation('email');
email.add( Validate.Email );
//
</script>



<?php

} else {


	if(empty($_POST['uname'])||
	empty($_POST['passwd1'])||
	empty($_POST['passwd2']))
	{

		echo "<div id=\"errbox\">";
		echo "You did not fill all fields!";
		echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";
		echo "</div>";

	} else {

		//////////////////// check if uname exists
		if(isUNameExists(trim($_POST['uname']))){
		  	echo "<div id=\"errbox\">";
			echo "Username already exists! Please use another username";
			echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";
			echo "</div>";
		} else {

			////////////// check if passwords not match
			if(trim($_POST['passwd1'])<>trim($_POST['passwd2'])){
				echo "<div id=\"errbox\">";
				echo "Password and Password Confirmation not match!";
				echo "<p><a href=\"javascript: history.back()\">Back to form</a></p>";
				echo "</div>";
			} else {
				///////////// wokey
				$status = 0;
				if(isset($_POST['status'])){
					$status = 1;
				}
				myConn();
				$q=mysql_fetch_array(mysql_query("select nama,telp,email from t_salesman where kode='$_POST[uname]'"));

				if(!isset($q['nama'])){
				$q=mysql_fetch_array(mysql_query("select nama,telp,email from t_supervisor where kode='$_POST[uname]'"));
				}
				$qu = mysql_query(sprintf("INSERT INTO user(
				usr_uname,
				usr_passwd,
				usr_fname,
				usr_mobile,
				usr_email,
				usr_class,
				usr_status) VALUES (
				%s,%s,%s,%s,%s,$_POST[uclass],$status)",
				quote_smart(trim($_POST['uname'])),
				quote_smart(trim(md5($_POST['passwd1']))),
				quote_smart(trim($q['nama'])),
				quote_smart(trim($q['telp'])),
				quote_smart(trim($email)))) or die(mysql_error());
				//
				$uid = mysql_insert_id();
				//
				mysql_close();
				//
				echo "<div id=\"okbox\">";
				echo "A new user has been added...";
				echo "</div>";

			}

		}

	}

}

?>
