var verifpass = function(){
   var normalpass = document.getElementById('normalpass').value;
   var repeatpass = document.getElementById('repeatpass').value;
   if (normalpass === repeatpass)
		document.getElementById('SignupButton').disabled = false;
   else
		document.getElementById('SignupButton').disabled = true;
}
