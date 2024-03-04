<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#aa0033";
			include "./scripts/theme-functions.php";
		?>
		<title>Raspberry Pi</title>
		<script src="./scripts/theme-functions.js"></script>
		<script src="./scripts/submit-functions.js"></script>
		<script src="./scripts/top-bar-functions.js"></script>
		<style>
			table,td,tr {border-collapse: collapse;border:0px solid black;margin:0px;padding:0px}
			.b{border: solid 2px #aa0033; margin: 0px; text-align: center; vertical-align: top; margin: 2px 1px; padding: 2px;}
			.b * {font-size: 16px; font-family: monospace; margin: 0px; font-weight: bold; padding: 2px}
			.b h3 {font-size: 20px; text-decoration: underline; margin: 10px 0}
			.green {background-color: rgba(0, 127, 0, 0.5)}
			.red {background-color: rgba(127, 0, 0, 0.5)}
			.ntmg {background-color: rgba(50, 0, 0, 0.5)}
			.moviedb {background-color: rgba(170, 85, 0, 0.5)}
			.naspi {background-color: rgba(63, 63, 255, 0.5)}
			.config {background-color: rgba(0, 0, 127, 0.5)}
			.raspi {background-color: rgba(170, 0, 51, 0.5)}
			.aqua {background-color: rgba(0, 127, 127, 0.5)}
			.true {background-color: rgba(0, 127, 0, 0.5)}
			.false {background-color: rgba(127, 0, 0, 0.5)}
		</style>
	</head>
	<body>
		<iframe name="top" src="top.html" width="100%" height="45px" style="border:0px solid #390000; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action="">
			<script src="../scripts/theme-form.js"></script>
			<script src="../scripts/submit-form.js"></script>
		</form>
		<div style="margin: 30px; margin-top: 75px; border: 2px solid #aa0033;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: #aa0033;">Raspberry Pi Dashboard</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: middle; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<p class="subtitle">Welcome to my Raspberry Pi.</p>
				<table width="100%" cellspacing="0px">
					<tr>
						<?php if (!isset($_GET['no-services'])) include "scripts/show-services-overview.php";?>
						<?php if (!isset($_GET['no-content'])) include "scripts/show-content-overview.php";?>
					</tr>
				</table>
				<script>
					// Get all <p> elements in the document
					const paragraphs = document.querySelectorAll('p');

					// Loop through each <p> element
					paragraphs.forEach(paragraph => {
					  // Check if the <p> element has the "true" class
					  if (paragraph.classList.contains('true')) {
						// Add a checkmark emoji before the content
						paragraph.innerHTML = '✔️ ' + paragraph.innerHTML;
					  }
					  // Check if the <p> element has the "false" class
					  else if (paragraph.classList.contains('false')) {
						// Add an x emoji before the content
						paragraph.innerHTML = '✖️ ' + paragraph.innerHTML;
					  }
					});
				</script>
			</div>
		</div>
	</body>
</html>
