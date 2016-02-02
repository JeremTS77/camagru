var add = function(name){

	document.getElementById('clipart').src="/client/images/"+name+".png";
	document.getElementById('clipprep').value="../client/images/"+name+".png";
	document.getElementById('startbutton').disabled = false;
};
