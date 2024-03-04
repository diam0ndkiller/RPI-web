function setFile(str) {
	document.getElementById("file").value = str;
}

function playNext(amount) {
	newFiles = ""
	for (i = amount; i < files_str.split(":").length; i++) {
		newFiles += files_str.split(":")[i] + ":"
	}
	if (amount == 0) current_time = document.getElementById("player").currentTime
	else current_time = 0
	setFile(newFiles.substr(0, newFiles.length-1))
	setCurrentTime(current_time)
}
