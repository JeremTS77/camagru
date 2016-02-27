<?php
include '../config/database.php';
session_start();
if (isset($_SESSION['login'])){
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	$login	= htmlspecialchars($_POST['login']);

	$img = $_POST['image'];
	$img = str_replace('data:image/jpeg;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$destim = base64_decode($img);
	$dest = imagecreatefromstring($destim);
	$image = imagecreatefrompng("../client/images/".$_POST['clip'].".png");

	imagealphablending($dest, true);
	imagesavealpha($dest, true);

	echo $_POST['coner'];
	if ($_POST['coner'] == 'br'){
		imagecopy($dest, $image, imagesx($dest)-imagesx($image), imagesy($dest)-imagesy($image), 0, 0, imagesx($image), imagesy($image));
	}
	else if ($_POST['coner'] == 'bl'){
		imagecopy($dest, $image, 0, imagesy($dest)-imagesy($image), 0, 0, imagesx($image), imagesy($image));
	}
	else if ($_POST['coner'] == 'tl'){
		imagecopy($dest, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	}
	else{
		imagecopy($dest, $image, imagesx($dest)-imagesx($image), 0, 0, 0, imagesx($image), imagesy($image));
	}
	ob_start();
	imagejpeg($dest);
	$image_data = ob_get_contents ();
	ob_end_clean ();
	$link = "data:image/jpeg;base64,".base64_encode($image_data);
	$stmt = $pdo->prepare("INSERT INTO ".$DB_TABLE['pictures']."(createur, link) VALUES(:login, :link)");
	$stmt->bindValue(':login', $login);
	$stmt->bindValue(':link', $link);
	$stmt->execute();

	imagedestroy($image);
	imagedestroy($dest);
	$pdo = NULL;
}
header('Location: /');
exit;
?>
