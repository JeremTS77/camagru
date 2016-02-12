#Camagru

#/
	->index.html		= define root document for server
	->php.ini			= define path for sendmail

##Config
	->Setup.php			= init database
	->database.php		= config username, password, etc for connect to the local database

##Server
	->Comment.php		= Write comment in DB and send an email to the user
	->login.php			= Select and compare hash for sign in
	->logout.php		= logout the user
	->recpicture.php	= merge picture and clipard and write it in DB
	->register.php		= write in dB new user from sign up form
	->Resetpassword.php	= send an email to reset password
	->Supppicture.php	= add delete date for one picture

##Client

###css
	->camagru.css		= define rules for camagru project without bootstrap

###images
	Folder for stock clipart

###scripts
	->addclip.js		= select a clipart for preview
	->take_picture.js	= fonction for take picture with the browers
	->verifypass.js		= check verif pass and normal pass and regex for strength

###views
	Folder for template html

	->entercode.php		= form for active account
	->galerie.php		= preview all picture taked
	->resetpassword.php	= form for reset password
	->signin.php		= form for sign in
	->signup.php		= form for sign up
