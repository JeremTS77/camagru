<?php
session_start();
if ($_SESSION['login'])
{
	echo "Vous etez deja connecté".PHP_EOL;
}
else{
	echo "Je vous emmene vous connecter".PHP_EOL;
	print("<script type=\"text/javascript\">setTimeout('location=(\"index.php\")' ,1000);</script>");
}


?>
