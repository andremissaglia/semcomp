<?php
if(!isset($_GET['pass']) || $_GET['pass'] != "semcompFTW17"){
	exit();
}
if(isset($_GET['ac']) && $_GET['ac'] == 'd'){
	unlink("email_list.txt");
}
if(isset($_GET['ac']) && $_GET['ac'] == 'l'){
	print file_get_contents("email_list.txt");
}
?>
