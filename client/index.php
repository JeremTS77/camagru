<?php
session_start();
?>
<!DOCTYPE HTML5>
<html>
	<head>
		<title>camagru</title>
	</head>
	<body>
		<form action="login.php" method="post">
			<input placeholder="login" name="login" type="text"/>
			<input placeholder="password" name="password" type="password"/>
			<input type="submit"/>
		</form>
	</body>
</html>
