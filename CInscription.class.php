<?php
Class CInscription // ***** class
{
    public function __construct()
    {
        return;
    }

// à faire remove_user

    public function send_validation($email, $Prenom, $Nom, $Keyuser) // envoi un email de validation 
    {
        $CSession = new CSession();
        $sujet = 'Confirmation d\'inscription Camagru';
        $message = 'Bonjour '.$Prenom.' '. $Nom.'<br />';
        $message .= "Félicitations vous venez de vous inscrire sur Camagru.<br />
        Pour valider cette inscription, il ne vous reste plus qu'à cliquer sur le lien suivant :";
        
        $host = $CSession->host();
        //$host = 'http:www.camagru.photeam.com';
        $message .= "<a href='".$host."register_chk.php?key=$Keyuser'> Validez votre incription</a>";
        //$message .= "<a href='http://$this->servername:8080/camagru/register_chk.php?key=$Keyuser'> Validez votre incription</a>";
        $from = 'dlievre@student.42.fr';

        //$CInscription = new CInscription();
        $action = $this->send_email($email, $sujet, $message, $from);
        if ($action != 'send email') {print ('erreur'); exit;}
        return($action);
    }

    public function send_reinitialisation($email) //    renvoi un mail de réinitialisation
    {
        $CSession = new CSession();
        $tbl_info_user = $CSession->user_info($email, 'email');
        $Prenom = $tbl_info_user['Prenom'];
        $Nom = $tbl_info_user['Nom'];
        $key = $CSession->maj_key($email);
        //print $key;
        if ($key == 'maj key err') {print ('erreur'); exit;}
        // gerer le compteur de tentatives de reinit
        $sujet = 'Demande de réinitialisation Camagru';
        $message = 'Bonjour '.$Prenom.' '. $Nom."\r\n";
        $message .= "Vous avez demandé la réinitialisation de votre mot de passe Camagru.\r\n
        Pour le changer, il ne vous reste plus qu'à cliquer sur le lien suivant : ";
        //$sujet = htmlentities ($sujet);
        $message = htmlentities ($message);
        $host = $CSession->host();
        $CSession->write_log('Réinitialisation de votre mot de passe pour '.$email );
//$message .= "<a href='http://$this->servername:8080/camagru/pwd_reinit_chk.php?key=$key'> Réinitialiser votre mot de passe</a>";
        $message .= "<a href=\"$host"."pwd_reinit_chk.php?key=$key\"> Réinitialiser votre mot de passe</a>";
        $from = 'dlievre@student.42.fr';

        //$CInscription = new CInscription();
        $action = $this->send_email($email, $sujet, $message, $from);
        if ($action != 'send email') {print ('send email erreur'); exit;}
        return($action);
    }

    public function set_key_validation() // crée la key de validation d'inscription
    {
        //$generatedKey = sha1(mt_rand(10000,99999).time().$email);
        $generatedKey = uniqid();
        // inscription de la key dans la base
        
        return($generatedKey);
    }

    public function get_key_validation() // recupère la key de validation d'inscription
    {
        //print ('<p>destruct</p>');
        return;
    }
    /*public function set_key_reinit($email)
    {
        //$generatedKey = sha1(mt_rand(10000,99999).time().$email);
        $generatedKey = uniqid();
        // inscription de la key dans la base
        
        return($generatedKey);
    }*/


    public function send_email($email, $sujet, $message, $from) // envoi un email
    {
        $CPrint = new CPrint();
        $CSession = new CSession();
        $codageiso = 'charset=iso-8859-1';
        $codageutf = 'charset=utf-8';
        $to  = $email;
        $to .= ', te42pe@gmail.com';
        $sujet = utf8_decode ($sujet);
        $message = utf8_decode ($message);
        //$message = htmlentities ($message); // a tester si ok
        $headers = "MIME-Version: 1.0\r\n"; 
        //$headers .= "Content-type: text/html; ".$codageutf."\r\n"; 
        $headers .='Content-Type: text/html; charset="iso-8859-1"'."\r\n";  
        $headers .='Content-Transfer-Encoding: 8bit' . "\r\n";
        $headers .= "From: ".$from."\r\nX-Mailer:PHP/". phpversion();  // 'X-Mailer: PHP/' . phpversion();

        if (mail($to, $sujet, $message, $headers))
        {
            $CSession->write_log("inscription : ".$to.' '. $sujet);
            return "send email";

        }
        else 
        {
            $CSession->write_log("Erreur de transmission email : $to $sujet");
            $CPrint->content(" Erreur de transmission email, contactez le support", 'msg_err');
            exit;
        }

        return;
    }

    // ***** structure *****
    public function __destruct()
    {
        return;
    }

    public function __toString() //print ($Form);
    {
        return('toString');
    }

    public function __invoke() //print ($Form());
    {
        return('invoke');
    }

    static function doc() // doc 
    {
        $info = '';
        //INSERT INTO `tbl_camagru` (`id`, `Nom`, `Prenom`, `email`, `password`, `info`) VALUES (NULL, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'test', 'sans');
        return (file_get_contents('superuser/documentation.txt'));
    }

}

?>
