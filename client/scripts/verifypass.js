var verifpass = function(){
   var normalpass = document.getElementById('normalpass').value;
   var repeatpass = document.getElementById('repeatpass').value;
   if (normalpass === repeatpass && /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=.\-_*])([a-zA-Z0-9@#$%^&+=*.\-_]){3,}$/.test(normalpass))
		document.getElementById('SignupButton').disabled = false;
   else
		document.getElementById('SignupButton').disabled = true;
}
