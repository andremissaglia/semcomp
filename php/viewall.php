<?php
if(!isset($_GET['pass']) || $_GET['pass'] != "semcompFTW17"){
	echo "Saindo, senha errada";
	exit();
}
if(isset($_GET['ac']) && $_GET['ac'] == 'd'){
	echo "Deletando lista";
	unlink("email_list.txt");
}
if(isset($_GET['ac']) && $_GET['ac'] == 'l'){
	echo "Exibindo lista";
	print file_get_contents("email_list.txt");
}
?>
