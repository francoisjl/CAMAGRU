<?php
Class CSession
{

    public static $verbose = False;
    private $servername = "localhost";
    private $username = "admin";
    private $password = "admin";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";

    public function __construct()
    {
        return;
    }

    public function login_usr()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        try {
            //$conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT id, Nom, Prenom, email, Password FROM ".$this->tbl." LIMIT 1"); 
            $requete->execute();
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                    if ($lignes->email == $email && $lignes->Password == $Password ){
                        if ($lignes->confirm == '1')
                            $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom, $lignes->confirm );
                        else
                            {
                                // renvoi du mail de validation
                            }
                    }
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        $conn = null;
        return;
    }

    public function exist_usr()
    {
        $email = strip_tags($_POST['email']);
        $exist = '';
        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT email FROM ".$this->tbl." LIMIT 5"); 
            $requete->execute();
            $exist = '';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                    if ($lignes->email == $email ) { $exist = 'yes'; }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur';}
        $conn = null;
        return($exist);
    }
        public function add_usr()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        $Confirm = 0;
        $Keyconfirm = 'dsdfsdfsdf';
////////// a faire pour valider l inscription
        // contre les injection sql : https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes
        try {
            //$conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("INSERT INTO ". $this->tbl."(Nom, Prenom, email, Password, Info) VALUES(".$requete->quote($_POST['Nom']).', '.$requete->quote($_POST['Prenom']).', '. $requete->quote($email).', '.$requete->quote($Password).", 'info')"); 
            $requete->execute();
            $var = 'ok';
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $var = 'bad';}
        $conn = null;
        return($var);
    }

    public function list_usr() // reservé superuser
    {
        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT Nom, Prenom, email FROM ".$this->tbl); 
            $requete->execute();
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                    print '<p>'.$lignes->email.'<br />';
                    print $lignes->Nom.'<br />';
                    print $lignes->Prenom.'<br />';
                    print '</p>';
                }

            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur';}
        $conn = null;
        return($exist);
    }

    public function set_session($email, $nom, $prenom, $confirm)
   {
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Confirm'] = $confirm;
        $_SESSION['valide'] = 'ok';

        return('ok');
   }

    public function get_Profile()
    {
        if ($_SESSION['valide'] == 'ok') {
            $tab = array();
            $tab[] = "Email"; $tab[] = $_SESSION['email'];
            $tab[] = "Nom"; $tab[] = $_SESSION['Nom'];
            $tab[] = "Prénom"; $tab[] = $_SESSION['Prenom'];
            $tab[] = "Confirmé"; $tab[] = $_SESSION['Confirm'];
            $tab[] = "Session"; $tab[] = $_SESSION['valide'];
            return($tab);
        }
        else
            return('erreur');
    }

    public function __destruct()
    {
        //print ('<p>destruct</p>');
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
        //INSERT INTO `tbl_camagru` (`id`, `Nom`, `Prenom`, `email`, `password`, `info`) VALUES (NULL, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'test', 'sans');
       return (file_get_contents('documentation.txt'));
    }



    
    public function kill_session()
   {
        $_SESSION = array(); session_destroy(); 
        return('ok');
   }


   
}


?>
