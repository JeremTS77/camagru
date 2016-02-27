var add = function(name){

	document.getElementById('coner').disabled = false;
	document.getElementById('clipart').src="/client/images/"+name+".png";
	document.getElementById('clipprep').value= name;
	document.getElementById('startbutton').disabled = false;
	console.log('toto');
	if (name == "arch")
		document.getElementById('coner').value = "br";
	else if (name == "birthday"){
		document.getElementById('coner').value = "top";
		document.getElementById('coner').disabled = true;
	}
	else
		document.getElementById('coner').value = "tl";
};
