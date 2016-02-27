#Camagru

##/
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

##DB
	->USERS		:
		*id			: primary key for build a ref on user
		*login		: unique used for singin
		*email		: unique used for active, reset and comment
		*mdp		: for singin
		*reset		: hash for reset request
		*confirm	: hash for confirm request
		*confirmed	: bool for corfirm the account

	->PICTURES	:
		*id			: primary key for buil a ref on picture
		*creation	: datetime for sort pictures by time in gallerie
		*deleted	: bool 0 == not deleted 1 == deleted
		*createur	: ref on user
		*link		: content base64 with the picture

	->COMMENTS	:
		*id			: ref on comment
		*creation	: sort by time they comments
		*auteur		: ref on user
		*comment	: content TEXT with the comment
		*photonum	: ref on pictures commented

	->LIKE		:
		*id			: ref on like (probably not used)
		*refphotoid	: ref on picture liked
		*login		: ref on user who has like the photo
