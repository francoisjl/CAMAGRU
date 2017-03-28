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
      return (file_get_contents('documentation.txt'));
    }

    public  function Form($Titre, $Tab) // affiche le form
    {
      print ('<div id="form">');
      print ('<h2 class="Titre">'.$Titre.'</h2>');
      print($Tab[0]);
      $nb = count($Tab);
      $Tab[] = " "; // evite pb index
      print('<table>');
      for ($key = 1; $key <= $nb; $key = $key + 2)
        echo '<tr><td class="form">'.$Tab[$key].'</td><td class="form">'.$Tab[$key +1].'</td></tr>';
      print('</table>');
      print('</form>');
      print('</div>');
      return;
    }

    public  function profil($Titre, $Tab) // affiche les info du user
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

     public  function content($Info, $class) // affiche avec p et class
    {
      print ('<p class="'.$class.'">'.$Info.'</p>');
      return;
    }

    public function content_array($Tab, $class1, $class2) // affiche un tableau à 2 Dimensions titre et contenu avec class css
    {
      print ("<p><table width=\"80%\">");
      foreach ($Tab as $key => $value)
        print ('<tr><td> <p class="'.$class1.'">'.$key.'</p></td><td><p class="'.$class2.'">'.$value.'</p></td></tr>');
      print ('</table></p>');
              //print ('<tr><td '.'class='.'>'.$key.'</td><td>'.$value.'</td></tr>');
      return;
    }

    public  function link($href, $text, $class, $target, $sep) // affiche un lien avec balise <a>
    {
      // affiche un lien avec un séparateur
      print ("<a href=\"$href\" class=\"$class\" target=\"$target\">$text</a>");
      if ($sep) print "<span class=\"menu\">  $sep </span>";
      return;
    }

    public  function div($id, $class) // affiche un div avec id et class
    {
      if ($id) $id = "id=\"$id\"";
      if ($class) $class = "class=\"$class\"";
      print "<div $id $class>";
    }

    public  function div_end() // ferme la balise du div
    {
      print "</div>";
    }

    public  function titre($Info) // affiche un titre H2
    {
      print ('<h2>'.$Info.'</h2>');
      return;
    }
}
?>