<?php
session_start();
require_once('includes_session.php');
require_once('head.php');
require_once('header.php');

$session = new CSession();//$_POST remove
$session->user_login();


print('<div id="main">');


	//include ('main.php');
//include ('aside.php');

print ('<p>Index</p>');

print('</div>');	
include ('footer.php');

?>
