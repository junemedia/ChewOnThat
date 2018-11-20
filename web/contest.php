<?php

while (list($key,$val) = each($_GET)) {
	$$key = $val;
}
while (list($key,$val) = each($_POST)) {
	$$key = $val;
}

if ($sSave) {
	$sMessage = '';
	
	
	if (!eregi("^[A-Za-z0-9\._-]+[@]{1,1}[A-Za-z0-9-]+[\.]{1}[A-Za-z0-9\.-]+[A-Za-z]$", trim($sEmail))) {
		$sMessage .= "Please enter valid email address.<br>";
	}

	if (!ctype_alpha(trim($sFirst))) {
		$sMessage .= "Please enter valid first name.<br>";
	}
	
	if (!eregi("^[-A-Z[:space:]'\.]*$", trim($sLast))) {
		$sMessage .= "Please enter valid last name.<br>";
	}
	
	if (!ereg("^[a-zA-Z0-9 \'\x2e\#\:\\\/\,\’\&\@()\°_-]{1,}$", trim($sAddress))) {
		$sMessage .= "Please enter valid address.<br>";
	}
	
	if (!ereg("^[a-zA-Z0-9 \'\x2e\#\:\\\/\,\’\&\@()\°_-]*$", trim($sAddress2))) {
		$sMessage .= "Please enter valid address2.<br>";
	}
	
	if (!ereg("^[a-zA-Z0-9 \'\x2e\-\’\`\&]{1,}$", trim($sCity))) {
		$sMessage .= "Please enter valid city.<br>";
	}
	
	if (!ereg("^[A-Z]{2,2}$", trim($sState))) {
		$sMessage .= "Please enter valid state.<br>";
	}
	
	if (!ereg("^[0-9-]{5,}$", trim($sZip))) {
		$sMessage .= "Please enter valid zip.<br>";
	}

	if ($sPhoneAreaCode != '' || $sPhoneExchange != '' || $sPhoneNum != '') {
		if (!(ctype_digit(trim($sPhoneAreaCode)) && strlen(trim($sPhoneAreaCode)) == 3 && trim($sPhoneAreaCode) >= 200)) {
			$sMessage .= "Please enter valid phone area code.<br>";
		}
	
		if (!(ctype_digit(trim($sPhoneExchange)) && strlen(trim($sPhoneExchange)) == 3 && trim($sPhoneExchange) >= 200)) {
			$sMessage .= "Please enter valid phone prefix.<br>";
		}
		
		if (!(ctype_digit(trim($sPhoneNum)) && strlen(trim($sPhoneNum)) == 4)) {
			$sMessage .= "Please enter valid phone suffix.<br>";
		}
	}
	
	
	
	
	
	
	if ($sMessage == '') {
		$sRemoteIp = trim($_SERVER['REMOTE_ADDR']);
		
		define('DB_NAME', 'chewonthat');    // The name of the database
		define('DB_USER', 'chewonthat');     // Your MySQL username
		define('DB_PASSWORD', 'Ch3w0nyeah'); // ...and password
		define('DB_HOST', 'mydb01.amperemedia.com');    // 99% chance you won't need to change this value
		
		
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		
		$query = "INSERT IGNORE INTO chewonthat.contest (email,first,last,address,address2,city,state,zip,phone,dateTimeAdded,ip)
					VALUES (\"$sEmail\",\"$sFirst\",\"$sLast\",\"$sAddress\",\"$sAddress2\",\"$sCity\",\"$sState\",
					\"$sZip\",\"$sPhoneAreaCode-$sPhoneExchange-$sPhoneNum\",NOW(),\"$sRemoteIp\")";
		$result = mysql_query($query);
		echo mysql_error();
		mysql_close($link);
		
		$sEmail = '';
		$sFirst = '';
		$sLast = '';
		$sAddress = '';
		$sAddress2 = '';
		$sCity = '';
		$sState = '';
		$sZip = '';
		$sPhoneAreaCode = '';
		$sPhoneExchange = '';
		$sPhoneNum = '';
		
		$sMessage = "<font face=verdana color=#FF0000><b>
					<a href='http://chewonthatblog.com/'>Request Has Been Submitted Successfully</a></b></font>
					<BR><BR><table align=center width=600><tr><td><ol></ol></td></tr></table>";
	} else {
		$sMessage = "<font face=verdana color=#FF0000><b>We could not process your entry because of missing or invalid answers</b></font>
					<BR><BR><table align=center width=600><tr><td><ol>$sMessage</ol></td></tr></table>";
	}
}


$state_array = array("AL"=>"Alabama","AK"=>"Alaska","AS"=>"American Samoa",
"AZ"=>"Arizona","AR"=>"Arkansas","CA"=>"California",
"CO"=>"Colorado","CT"=>"Connecticut","DE"=>"Delaware",
"DC"=>"District of Columbia","FL"=>"Florida","GA"=>"Georgia",
"GU"=>"Guam","HI"=>"Hawaii","ID"=>"Idaho","IL"=>"Illinois",
"IN"=>"Indiana","IA"=>"Iowa","KS"=>"Kansas","KY"=>"Kentucky",
"LA"=>"Louisiana","ME"=>"Maine","MH"=>"Marshall Islands",
"MD"=>"Maryland","MA"=>"Massachusetts","MI"=>"Michigan",
"MN"=>"Minnesota","MS"=>"Mississippi","MO"=>"Missouri",
"MT"=>"Montana","NE"=>"Nebraska","NV"=>"Nevada","NH"=>"New Hampshire",
"NJ"=>"New Jersey","NM"=>"New Mexico","NY"=>"New York",
"NC"=>"North Carolina","ND"=>"North Dakota","OH"=>"Ohio",
"OK"=>"Oklahoma","OR"=>"Oregon","PW"=>"Palau","PA"=>"Pennsylvania",
"PR"=>"Puerto Rico","RI"=>"Rhode Island","SC"=>"South Carolina",
"SD"=>"South Dakota","TN"=>"Tennessee","TX"=>"Texas","TT"=>"Trust Territories",
"UT"=>"Utah","VT"=>"Vermont","VI"=>"Virgin Islands","VA"=>"Virginia",
"WL"=>"Wake Island","WA"=>"Washington","WV"=>"West Virginia","WI"=>"Wisconsin","WY"=>"Wyoming");
$sStateOptions = "<option value=''>";
while (list($key,$val) = each($state_array)) {
	if ($key == $sState) {
		$sSelected = " selected";
	} else {
		$sSelected = "";
	}
	$sStateOptions .= "<option value='$key'$sSelected>$val";
}

?>
<html>

<head>
<title>Chew on That Contest Form</title>

<script language="JavaScript">
function checkFields () {
	if (document.form1.sEmail.value == '' || document.form1.sFirst.value == '' || document.form1.sLast.value == '' || document.form1.sAddress.value == '' || document.form1.sCity.value == '' || document.form1.sState.selectedIndex == 0 || document.form1.sZip.value == '') {
		alert ("All fields are required except address2.");
		return false;
	} else {
		return true;
	}
}
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0000FF" vlink="#330033" alink="#006600">
<font face="Verdana, Arial, Helvetica">
<p align="center">
<a href="http://chewonthatblog.com/">
<img src="http://chewonthatblog.com/wp-content/themes/ChewonThat/images/header_chef.jpg" width="640" height="195" border="0">
</a>
</p>

<table border="0" align="center" cellpadding="0" cellspacing="0" width="710">
<tr><td valign="top" ><p align="center"><font face="verdana"><?php echo $sMessage;?><br>
<font face=verdana color="Black"><b><u>Alternative Method of Entry Form</u></b></font>
<BR><BR>
</font></p>
</td></tr></table>




<form action="<?php echo $_SERVER['PHP_SELF'];?>" name="form1" method="post" onsubmit="return checkFields();">
    <center>
  </font><table border="0" cellpadding="0" cellspacing="0" width="450" height="148">
<tr>
      
	  	<td valign="top" height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">Email:</font></td>
        	<td valign="top" align="left" height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">
        	<input type="text" name="sEmail" value='<?php echo $sEmail;?>' size="25">
        	</font>
	  	
		<input type="hidden" name="switch" value="on"></td>
	    
    </tr>
    <tr>
      <td valign="top"  height="25" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">First Name:</font></td>
      <td valign="top"  align="left" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica"><input type="text" name="sFirst" value='<?php echo $sFirst;?>' size="25"></font>
    </td>
    </tr>
    <tr>
      <td valign="top"  height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">Last Name:</font></td>
      <td valign="top"  align="left" height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica"><input type="text" name="sLast" value='<?php echo $sLast;?>' size="25"></font>
    </td>
    </tr>
    <tr>
      <td valign="top"  height="25" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">Address:</font></td>
      <td valign="top"  align="left" height="25" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica"><input type="text" name="sAddress" value='<?php echo $sAddress;?>' size="25">
      
      <input type="text" name="sAddress2" value='<?php echo $sAddress2;?>' size="15">
      </font>
    </td>
    <tr>
      <td valign="top"  height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">City:</font></td>
      <td valign="top"  align="left" height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica"><input type="text" name="sCity" value='<?php echo $sCity;?>' size="25"></font>
	</td>
    </tr>
    <tr>
      <td valign="top"  height="23" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">State:</font></td>
      <td valign="top"  align="left" height="23" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">
        <select name="sState" size="1"> 
			<?php echo $sStateOptions; ?>
	  </select>
</font>
</td>
    </tr>
    <tr>
      <td valign="top"  height="25" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">Zip Code:<br>
        </font></td>
    
      <td valign="top"  align="left" height="25" valign="top" bgcolor="FFE8C8"><font face="Verdana, Arial, Helvetica">
        <input type="text" name="sZip" maxlength="5" value='<?php echo $sZip;?>' size="10"></font><font size="1" face=verdana> (5-digits only, please)</font>
  </td>
    </tr>
    <tr>
      <td valign="top"  height="25" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">Phone:</font></td>
      <td valign="top"  align="left" height="25" bgcolor="F0FFF0"><font face="Verdana, Arial, Helvetica">
      <input type="text" name="sPhoneAreaCode" value='<?php echo $sPhoneAreaCode;?>' size="3" maxlength="3">
      <input type="text" name="sPhoneExchange" value='<?php echo $sPhoneExchange;?>' size="3" maxlength="3">
      <input type="text" name="sPhoneNum" value='<?php echo $sPhoneNum;?>' size="4" maxlength="4"> &nbsp;<font size="1">(optional)</font>
      </font>
	</td>
    </tr>
    
    
    
    <tr>
      <td valign="top"  height="25" bgcolor="FFFFFF" colspan=2>
	<br><p align="center">
	<input type="submit" value="Click Here To Enter The Contest" name="sSave"></p>
	</td>
	</tr>
  </table><font face="Verdana, Arial, Helvetica">
</form>
</font>
</body>
</html>
