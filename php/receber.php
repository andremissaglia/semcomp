<?php
$email = $_POST['email'];
if(preg_match("/^[a-zA-Z0-9\._-]+@([a-zA-Z0-9])(.[a-zA-Z0-9]+)*$/",$email,$matches)){	
	$handle = fopen("email_list.txt","a");
	fwrite($handle, $email."\n");
	fclose($handle);
} else {
	echo "invalid\n";
}
header("Location: index.html");

?>
