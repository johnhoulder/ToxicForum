<?php
include("headers.php");
if(isset($_POST['submit'])){
	$query = mysql_query("SELECT * FROM `users` WHERE `fid` = '".$fid."' AND `username` = '".addslashes($_POST['username'])."'") or die("Username invalid");
	error_reporting("E_ALL");
	$query = mysql_fetch_array($query) or die("WARNING: Error detected on line 6");
	if($query['password'] == md5(sha1($_POST['password']))){
		$_SESSION['id'] = $query['id'];
		echo("Page refreshing, if the page doesn't load in 10 seconds, click <a href=\"./\">here</a><meta http-equiv=\"refresh\" content=\"0;URL=./\">");
	}else{
		echo("Incorrect Password");
	}
}
?>
<p><br>
  Login</p>
<form name="login" method="post" action="">
  <p>
    Username
    <input type="text" name="username" id="username">
    <br>
    Password  
    <input type="text" name="password" id="password">
    <br>
    <input type="submit" name="submit" id="submit" value="Submit">
  </p>
</form>
<p>&nbsp;</p>
