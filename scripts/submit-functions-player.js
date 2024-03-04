function clickRefreshButton() {
	document.getElementById("current_time").value = document.getElementById("player").currentTime
	document.getElementById("refresh").click();
}

function clickSubmitPhpButtonVanilla() {
	document.getElementById("volume").value = document.getElementById("player").volume
	document.getElementById("php-run").click();
}

function clickSubmitPhpButton() {
	document.getElementById("current_time").value = document.getElementById("player").currentTime
	document.getElementById("paused").value = paused
	clickSubmitPhpButtonVanilla()
}
