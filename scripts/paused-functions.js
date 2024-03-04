function togglePause() {
	if (document.getElementById("player").paused) {
		document.getElementById("player").play()
	} else {
		document.getElementById("player").pause()
	}
	updatePauseButton()
}

function updatePauseButton() {
	if (!document.getElementById("player").paused) {
		paused = false
		document.getElementById("play_button").innerHTML = "<p style=\"margin: 10px\">⏸️</p>"
	} else {
		paused = true
		document.getElementById("play_button").innerHTML = "<p style=\"margin: 10px\">▶️</p>"
	}
}
