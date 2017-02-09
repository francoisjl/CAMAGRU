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
		$CSession = new CSession();
		$CPrint = new CPrint();
		if ( $CSession->kill_session() == 'ok') 
			{ 
				$CPrint->titre('Votre session est terminée');
			}
			else
			{
				$CPrint->content('Votre session n\'existe pas', 'msg_err');

			}
		$CPrint->content('<a href="index.php"> Retour à l\'accueil</a>', 'content');
		print('</div>');	
		print '
    	<script  type="text/javascript">
    	var elem = document.querySelector(\'#header_user\');
    	elem.style.display = "none";
    	</script>';
    	include ('footer.php');
    }
?>