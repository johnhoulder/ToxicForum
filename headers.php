<?php
session_start();
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
}else{
$id = 0;
}
include("dbcon.php");
include("functions.php");
$url = $_SERVER['REQUEST_URI'];
$url = explode("/", $url);
$url = "/".$url[1]."/";
$fid = getid($url);
echo("<title>ToxicForums - ".gettitle($url)."</title>");
if($_SERVER['REMOTE_ADDR'] != "94.7.103.115" && $_SERVER['REMOTE_ADDR'] != "127.0.0.1"){
	die("Sorry, this site is under construction.");
}
if(checkforum($url) == false){
	die("This forum has an issue. Please contact support");
}
error_reporting("E_NONE");
if($_GET['logout'] == true){
	session_destroy();
	?><meta http-equiv="refresh" content="0 URL=./" /><?php
}
error_reporting("E_ALL");
?>
<style type="text/css">
/*
Theme Name: Tornado's end
Theme Version: 1.0.1
Theme Author: John
Theme Contributers: None
Theme webpage: http://vps.frozenmafia.com/f/
*/
.style1{
color: #666666;
border-bottom-style: none;
border-top-style: solid;
border-color: #999999;
}
.nav{
color: #666666;
border-bottom-style: solid;
border-color: #999999;
}
a.hover{
color: #00FF00;
}
</style>

<span class="style1">Welcome, 
<?= getuser($id); ?>
</span><br />
<?php if(getuser($_SESSION['id']) == "Guest"){ echo(offnav()); }else{ echo(onnav()); } ?>
<br />