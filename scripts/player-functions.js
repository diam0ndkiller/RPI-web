function buildPlayer() {
	args=" controls";
	if (repeat) args=args + " loop";
	if (!paused) args=args + " autoplay";
	if (video_file) document.write('<video id="player" style="width: 100%;" src="share' + file + '"' + args + '></video>')
	else document.write('<audio id="player" style="width: 100%;" src="share' + file + '"' + args + '></audio>')

	document.getElementById("player").currentTime = current_time
	document.getElementById("player").volume = volume
	document.getElementById("player").paused = paused
}

function loadPlayerEvents() {
	document.getElementById("player").addEventListener("ended", function(){playNext(1);clickSubmitPhpButtonVanilla()})
	document.getElementById("player").addEventListener("play", updatePauseButton)
	document.getElementById("player").addEventListener("pause", updatePauseButton)
}
