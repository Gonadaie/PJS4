function setfilename(){
	var thefile = document.getElementById('file');
	var label = document.getElementById('label_input2');
	var name='';
	console.log(name);
	for(var i = thefile.value.length; i >= 0; i--){
		if (thefile.value[i]=="\\"){
			break;
		}
		if(name === "undefined") name = thefile.value[i];
		else name = name + thefile.value[i];
	}
	console.log(name);
	name = name.reverse();
	console.log(name);
	label.innerHTML = name;
}

String.prototype.reverse=function ()
{
        var n   =  '';
        for( var i=this.length-1; i >= 0; i--)
                n       +=     this.charAt(i);
        return n;
}
