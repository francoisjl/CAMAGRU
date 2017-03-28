<?php
require_once('includes_session.php');
if (!$_SESSION["email"] || $_SESSION["valide"] !='ok') {header('Location: login.php');} 
if ($_SESSION["valide"]=='ok') {header('Location: home.php');}
?>
