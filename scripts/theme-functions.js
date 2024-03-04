function toggleTheme() {
	s = document.getElementById('theme').value
	if (s == "dark") document.getElementById('theme').value = "light"
	else document.getElementById('theme').value = "dark"
}

function drawThemeButton(bgColor) {	
	args="";
	if (theme == "dark") args = args + " background-color: " + bgColor + ";";
	document.write('<button style="font-size: 20px;' + args + '" onclick="toggleTheme();clickSubmitPhpButton()"><p style="margin: 10px;">🌚</p></button>')
}
