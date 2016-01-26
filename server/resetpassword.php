<?php
$email = htmlspecialchars($_POST['email']);
$headers = 'From: Admin<admin@camagru.42.fr>' . "\r\n" .
     'Reply-To: <admin@camagru.42.fr>' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
mail($email, "Reset Password", "YoloSwag", $headers);

?>
