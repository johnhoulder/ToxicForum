<?php
error_reporting("E_NONE");
$url = $_SERVER['REQUEST_URI'];
$url = explode("/", $url);
$url = "/".$url[1]."/";
error_reporting("E_ALL");
function checkforum($id){
	$query = mysql_query("SELECT * FROM `forums` WHERE `dir` = '".$id."'");
	$query = mysql_fetch_array($query);
	if($query['suspended'] == 1 || $query['error'] == 1 || $query['locked'] == 1 || $query['banned'] == 1){
		return(false);
	}else{
		return(true);
	}
}
function getid($urlin){
	$query = mysql_query("SELECT * FROM `forums` WHERE `dir` = '".$urlin."'");
	$query = mysql_fetch_array($query);
	return($query['id']);
}
function gettitle($url){
	$query = mysql_query("SELECT * FROM `forums` WHERE `dir` = '".$url."'");
	$query = mysql_fetch_array($query);
	return($query['title']);
}
function getuser($id){
	$query = mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'");
	$query = mysql_fetch_array($query);
	if($query['username'] == ""){
		return("Guest");
	}else{
		return($query['username']);
	}
}
function getpermission($perm, $level){
	$url = $_SERVER['REQUEST_URI'];
	$url = explode("/", $url);
	$url = "/".$url[1]."/";
	$fid = getid($url);
	$query1 = mysql_query("SELECT * FROM `userlevels` WHERE `fid` = '$fid' AND `level` = '$level'") or die("Unable to fetch forum permissions. Lockdown commencing");
	$query = mysql_fetch_array($query1, MYSQL_ASSOC);
	if($query[$perm] == 1){
		return true;
	}else{
		return false;
	}
}
function offnav(){
	echo("<span class=\"nav\"><a href=\"login.php\">Login</a></span>");
}
function onnav(){
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
	}else{
		$id = 0;
	}
	$userinfo = mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'");
	$userinfo = mysql_fetch_array($userinfo);
	echo("<span class=\"nav\"><a href=\"index.php?logout=true\">Logout</a> <a href=\"ucp.php\">UCP</a> ");
	echo((getpermission("sadmin", $userinfo['userlevel']) == true ? "<a href=\"sadmin.php?page=home\">Server Administration</a>" : "not admin"));
	echo("</span>");
}
function getpremium($url){
	$query = mysql_query("SELECT * FROM `forums` WHERE `dir` = '".$url."'");
	$query = mysql_fetch_array($query);
	if($query['premium'] == 0)
		return false;
	else
		return true;
}
?>