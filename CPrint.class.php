<?php
Class CPrint{
    public $newvar = 0;
    public static $verbose = False;

    public function __construct()
    {
        return;
    }

    public function __destruct()
    {
         if (self::$verbose == True)
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
       return (file_get_contents('Form.doc.txt'));
    }

   public  function Form($Titre, $Tab)
    {
      print ('<div id="form">');
    	print ('<h2 class="Titre">'.$Titre.'</h2>');
    	print($Tab[0]);
      print('<table>');
      for ($key = 1; $key <=count($Tab);$key = $key + 2)
        echo '<tr><td class="form">'.$Tab[$key].'</td><td class="form">'.$Tab[$key + 1].'</td></tr>';
      print('</table>');
      print('</form>');
      print('</div>');
        return;
    }
       public  function Profil($Titre, $Tab)
    {
      print ('<div id="profile">');
      print ('<h2 class="Titre">'.$Titre.'</h2>');
      print('<table>');
      for ($key = 0; $key <=count($Tab);$key = $key + 2)
        echo '<tr><td class="">'.$Tab[$key].'</td><td class="">'.$Tab[$key + 1].'</td></tr>';
      print('</table>');
      print('</div>');
      return;
    }
           public  function Content($Info)
    {
      print ('<p>'.$Info.'</p>');
      return;
    }
}
?>