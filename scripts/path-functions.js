function setPath(str) {
	document.getElementById("path").value = str
}

function pathUp() {
	setPath(path.split(path.split("/")[path.split("/").length-2])[0])
}	
