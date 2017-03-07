<?php
if(!isset($_SESSION)) {session_start();}
print('</div>'); // div  global
print'<div id="footer">';
$CView->content('Camagru by dlievre & tpasqual', 'notice');
//print '<p>Camagru</p>';
print '</div>';
print'</body>';
print'</html>';
?>