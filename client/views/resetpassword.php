<?php
session_start();
if(!isset($_SESSION['login'])){
	if(isset($_GET['reset'])){
?>
<!DOCTYPE HTML5>
<html>
	<head>
	<meta charset="utf-8" />
		<title>CAMAGRU</title>
		<link rel="stylesheet" type="text/css" href="/client/css/camagru.css" media="all"/>
		<link href='https://fonts.googleapis.com/css?family=Averia+Sans+Libre' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<header>
			<h1>CAMAGRU</h1>
			<nav>
			<a href="/client/views/signup.php">Create your account</a>
			<a href="/client/views/signin.php">Already register ?</a>
			</nav>
		</header>
		<h2 class="PageTitle">Reset Password</h2>

		<form name="resetlast" action="/server/resetpassword.php" method="post" accept-charset="utf-8">
			<input name="reset" value="<?php echo $_GET['reset']; ?>"/>
			<div class="password">
				<label for="password">Password</label>
				<input id="normalpass" type="password" name="password" placeholder="password" onkeyup="verifpass();" required>
			</div>
			<div class="password">
				<label for="confpassword">Confirm</label>
				<input id="repeatpass" type="password" name="confpassword" placeholder="repeat password" onkeyup="verifpass();" required>
			</div>
			<input type="submit" value="Login" id="SignupButton" disabled/>
		</form>

	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
	<script src="/client/scripts/verifypass.js"></script>
	</body>
<html>

<?php
	}
	else{
?>
<!DOCTYPE HTML5>
<html>
	<head>
	<meta charset="utf-8" />
		<title>CAMAGRU</title>
		<link rel="stylesheet" type="text/css" href="/client/css/camagru.css" media="all"/>
		<link href='https://fonts.googleapis.com/css?family=Averia+Sans+Libre' rel='stylesheet' type='text/css'>
	</head>

			<header>
			<h1>CAMAGRU</h1>
			<nav>
			<a href="/client/views/signup.php">Create your account</a>
			<a href="/client/views/signin.php">Already register ?</a>
			</nav>
		</header><body>
		<h2 class="PageTitle">Reset Password</h2>

		<div class= "form">
			<form name="reset" action="/server/resetpassword.php" method="post" accept-charset="utf-8">
				<div class="input">
					<label for="email">Email</label>
					<input name="email" type="email" placeholder="email" required autofocus>
				</div>
				<button type="Submit" class="FormButton">reset password</button>

				</form>
		</div>

	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>


	</body>
<html>
<?php
	}
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
