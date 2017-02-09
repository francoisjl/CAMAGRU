<?php
session_start();
require_once('CSession.class.php');
require_once('CInscription.class.php');
include_once ('CForm.class.php');
include_once ('CPrint.class.php');
// tableau des questions secretes
$Tabquestion = array();
$Tabquestion[] = "Choisir la question secrète...";
$Tabquestion[] = "Le nom de votre chien";
$Tabquestion[] = "Le prénom de votre meilleur ami";
$Tabquestion[] = "Votre nom de jeune fille";
$Tabquestion[] = "Votre sport favori";
?>
