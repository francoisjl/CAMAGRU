<?php
if(!isset($_SESSION)) {session_start();}

require_once('database.php');

Class CSetup // ***** Class 
{
    public static $verbose = False;

    private $tbl = "tbl_camagru";
    private $tbl_photos = "photos";
    private $tbl_photos_like = "photos_like";

// **********  gestion de l'utilisateur ***********
    public function __construct() // initialise les info de la base de donnees
    {
        $db = new CDatabase();
        $this->conn = $db->database('setup');

        return;
    }

    public function host() // précise le nom du serveur pour l'envoi des liens par mail
    {
        $host = 'http://'.$this->servername.':8080/camagru/';
        return ($host);
    }

    public function create_base() // check si login mot de passe sont valides
    {
        //***** create database
        try {
            $rq = $this->secure("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci; USE `camagru`;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create database camagru <br/>'. '<br />';
        
        //***** create table camagru
        try {
            $rq = $this->secure("CREATE TABLE `tbl_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Questionsecrete` int(11) NOT NULL,
  `Reponsesecrete` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Info` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table camagru <br/>'. '<br />';

        //***** create database
        try {
            $rq = $this->secure("INSERT INTO `tbl_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Questionsecrete`, `Reponsesecrete`, `Info`) VALUES
(1, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '589b460c5244c', 5, 4, 'vÃ©lo', 'sans'),
(2, 'PASQUALINI', 'thierry', 'te42pe@gmail.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '589b3c7428e19', 5, 4, 'cheval', 'info'),
(3, 'dupond', 'louis', 'dupond@lievre.net', 'test', 0, '', 5, 0, '', 'free'),
(4, 'DURAND', 'robert', 'durand@lievre.net', 'test', 0, '', 5, 0, '', 'free'),
(5, 'PINGUET', 'Dominique', 'dominique@photeam.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, '589a0199da59a', 5, 0, '', 'info'),
(6, 'PASQUALI', 'thierry', 'tpasqual@student.42.fr', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, 'sdfgsdhf', 5, 0, '', 'info'),
(7, 'lievre', 'Dominique', 'portable@photeam.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(10, '', '', 'test@lievre.net', '', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(12, 'BERTRAND', 'merci', 'merci@adopteunvieux.com', 'test', 0, '5899e67abfeb9', 5, 0, '', 'Info'),
(17, 'UTF8', 'titi', 'utf8@yopmail.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, '589b548c55076', 5, 4, 'vÃ©lo', 'Info'),
(18, 'nom', 'prenom', 'prenom.nom@free.fr', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '58a333f4303d1', 5, 1, 'aucun', 'Info'),
(19, 'ivan', 'strum', 'ivan.strum@laposte.net', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '58a33533447a0', 5, 1, 'nom', 'Info'),
(20, 'Kohn-Hue', 'Alain', 'alain.kohn-hue@laposte.net', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 1, '58a464b769c9f', 5, 3, 'Kohn-Hue', 'Info'),
(21, 'O\'Reilly', 'auralie', 'portable@mariage-photo.com', '8aca2602792aec6f11a67206531fb7d7f0dff59413145e6973c45001d0087b42d11bc645413aeff63a42391a39145a591a92200d560195e53b478584fdae231a', 1, '58aedfb482511', 5, 4, 'vÃ©lo', 'Info');
");
            $rq = utf8_decode ($rq); 
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok insert data tbl camagru <br/>'. '<br />';

        //***** CREATE TABLE `photos`
        try {
            $rq = $this->secure("CREATE TABLE `photos` (
  `Id` int(11) NOT NULL,
  `Id_owner` int(11) NOT NULL,
  `Name_img` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Nb_liked` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table photos <br/>'. '<br />';

                //***** INSERT INTO `photos` 
        try {
            $rq = $this->secure("INSERT INTO `photos` (`Id`, `Id_owner`, `Name_img`, `Date`, `Nb_liked`) VALUES
(2, 2, 1487261170, '2017-02-16 16:06:10', 2),
(3, 1, 1487264490, '2017-02-16 17:01:30', 3),
(4, 1, 1487324144, '2017-02-17 09:35:44', 1),
(5, 1, 1487083850, '2017-02-20 16:19:24', 5),
(6, 1, 1487079862, '2017-02-20 16:20:17', 5),
(7, 1, 1487582622, '2017-02-20 09:23:43', 0),
(8, 1, 1487006282, '2017-02-20 16:21:29', 4),
(9, 1, 1487692326, '2017-02-21 15:52:07', 0),
(11, 2, 1487873367, '2017-02-23 18:09:27', 2);");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok insert data table photo<br/>'. '<br />';

                //***** CREATE TABLE `photos_like`
        try {
            $rq = $this->secure("CREATE TABLE `photos_like` (
  `Id` int(11) NOT NULL,
  `Id_tblphotos` int(11) NOT NULL,
  `Id_img` int(11) NOT NULL,
  `Id_user_comment` int(11) NOT NULL,
  `Comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Grave_bien` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create table photos_like <br/>'. '<br />';

                //***** INSERT INTO `photos_like`
        try {
            $rq = $this->secure("INSERT INTO `photos_like` (`Id`, `Id_tblphotos`, `Id_img`, `Id_user_comment`, `Comment`, `Grave_bien`) VALUES
(0, 3, 1487264490, 1, 'grave bien cette photo', 1),
(3, 3, 1487264490, 2, 'trop fort cette photo', 1),
(9, 9, 1487692326, 2, 'super ce chat', 0),
(10, 7, 1487582622, 2, 'trop top', 0),
(12, 2, 1487261170, 1, 'bonjob 8', 1),
(13, 11, 1487873367, 1, 'binÃ´me d\'enfer', 1),
(14, 2, 1487261170, 21, NULL, 1),
(15, 4, 1487324144, 21, NULL, 1),
(16, 3, 1487264490, 21, NULL, 1),
(17, 11, 1487873367, 21, NULL, 1);");
            $rq = utf8_decode ($rq); 
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok data database photos_like <br/>'. '<br />';

        //***** create index
        try {
            $rq = $this->secure("ALTER TABLE `photos`
  ADD PRIMARY KEY (`Id`);
ALTER TABLE `photos_like`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_img` (`Id_tblphotos`);
ALTER TABLE `tbl_camagru`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create Index <br/>'. '<br />';

        //***** create AUTO_INCREMENT
        try {
            $rq = $this->secure("ALTER TABLE `photos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
ALTER TABLE `photos_like`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
ALTER TABLE `tbl_camagru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create AUTO_INCREMENT <br/>'. '<br />';

        //***** create CONSTRAINT
        try {
            $rq = $this->secure("ALTER TABLE `photos_like` ADD CONSTRAINT `delete_img` FOREIGN KEY (`Id_tblphotos`) REFERENCES `photos` (`Id`) ON DELETE CASCADE;");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            }
        catch(PDOException $e)
        { echo "Error Database : " . $e->getMessage(); }

        print ' ok create CONSTRAINT <br/>'. '<br />';

        print ' Database valide <br/>'. '<br />';

$conn = null;
        return ;
    }

    function secure($var) // supprime les tag html
    {
        $var = strip_tags($var);
        //$var = addslashes ($var); // ajoute \ au string avec ' " exemple (c'est)
        $var = str_replace ( '$' , '', $var);
        return($var); // pour l'instant on ne fait que le strip_tags car protege par 'value'
        //return (mysql_real_escape_string($var)); // ne fonctionne pas
        //return($var);
    }

    private function quotesep($val)// securise les variables dans sql, avec separateur
    {
        return("'".$val."', ");
    }

    private function quote($val)// securise le passage des variables dans la requete sql, sans separateur
    {
        return("'".$val."'");
    }


    public function kill_session() // on tue la session et les variables
    {
        $_SESSION = array(); session_destroy(); 
        return('ok');
    }


 
    //***** structure *****

    public function __destruct() // on efface la connexion a la base
    {
        //print ('<p>destruct</p>');
        $this->conn = null; 
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

static function doc()
{
    $info = '';
    return (file_get_contents('superuser/documentation.txt'));
}


}

$CSetup = new CSetup();

print 'Initialisation de la base<br />';
$CSetup->create_base();


?>
