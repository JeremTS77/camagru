var add = function(name){

	document.getElementById('clipart').src="/client/images/"+name+".png";
	document.getElementById('clipprep').value= name;
	document.getElementById('startbutton').disabled = false;
};
