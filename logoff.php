<?php
require_once('includes_session.php');
if ($_SESSION["valide"] !='ok')
	{
		header('Location: index.php');
	}
else
	{
		require_once('head.php');
		require_once('header.php');
		print('<div id="main">');
		$session_off = new CSession();
		if ( $session_off->kill_session() == 'ok') 
			{ 
				print '<h2>Votre session est terminée<h2>';
			}
			else
			{
				print '<h2>Votre session n\'existe pas<h2>';

			}
		print '<p><a href="index.php"> Retour à l\'accueil</a></p>';
		print('</div>');	
		print '
    	<script  type="text/javascript">
    	var elem = document.querySelector(\'#header_user\');
    	elem.style.display = "none";
    	</script>';
    	include ('footer.php');
    }
?>