<?php
require_once('includes_session.php');
//require_once('Session.class.php');
//session_start();
$session = new CSession();
$session->user_login();
$session_usr_exist = new CSession($_POST);
//print ($session_usr_exist->user_exist());
//exit();

if ($_SESSION['valide'] == 'ok') 

{header('Location: home.php');}
else
{header('Location: index.php');}
//print 'session status get '.$_SESSION["status"].'<br />';
/*$formget = new CFormGet;
foreach ($_POST as $key => $value)
print ($value.'<br />');*/
//$_SESSION["user"]=$_POST['email'];
//$_SESSION["valide"]='ok';
//print ('session : '.$_SESSION["user"].'<br />');
//if ($_SESSION["valide"]=='oui') {header('Location: index.php');}
//header('index.php');
?>