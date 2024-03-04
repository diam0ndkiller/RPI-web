<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#ff0000";
			include "../scripts/theme-functions.php";
			include "../scripts/session-functions.php";
			if (!isValidSession(getSessionCookie())) redirectToLogin($theme);
		?>
		<title>System Load - RPI</title>
		<script src="../scripts/theme-functions.js"></script>
		<script src="../scripts/top-bar-functions.js"></script>
		<script src="../scripts/submit-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="top.html" width="100%" height="45px" style="border:0px solid #390000; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action=""><input type="hidden" id="theme" name="theme" value="<?php echo $theme;?>"><input style="margin: 0px; display: none;" type="submit" id="php-run" value="run"></form>
		<div style="border: 2px solid #ff0000; margin: 30px; margin-top: 75px">
			<div style="margin: 30px;" style="margin: 30px;">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: <?php echo $accent_color;?>;">System Load - RPI</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td>
							<h5 class="title" style="font-size:28px; margin: 0px;">Running Processes and Resource Usage of the RPI (<tt>top</tt>):</h5>
						</td>
						<td style="text-align: right; vertical-align: middle">
							<form method="post">
								<input type="submit" value="Refresh Status" name="refresh" id="refresh">
							</form>
						</td>
					</tr>
				</table>
				<div margin='20px' style="background-color:#323232; color:#cccccc; border: 2px solid #000000" id="output">
					<?php
						if(isset($_POST['refresh']) || isset($_POST['restart'])) {
							echo "<pre>".shell_exec("sudo -S ./sudoscript.py status-info 2>&1")."</pre>";
						} else { echo "<tt>Loading Status...</tt><script>clickRefreshButton()</script>"; }
					?>
				</div>
				<table width="100%" style="margin-top: 10px; text-align: right">
					<tr>
						<td width="*"></td>
						<td>
							<?php
								if(isset($_POST['reboot'])) {
									echo "<p class='content' style='color: #88aa00; margin: 0px;'>Rebooting RPI (please refresh in a few moments)</p>";
									shell_exec("sudo -S ./sudoscript.py reboot 2>&1");
								}
							?>
							<?php
								if(isset($_POST['shutdown'])) {
									echo "<p class='content' style='color: #88aa00; margin: 0px;'>Shutting down RPI</p>";
									shell_exec("sudo -S ./sudoscript.py shutdown 2>&1");
								}
							?>
						</td>
						<td width="100px">
							<form method="post">
								<input type="submit" value="Reboot RPI" name="reboot" id="reboot">
							</form>
						</td>
						<td width="100px">
							<form method="post">
								<input type="submit" value="Shutdown RPI" name="shutdown" id="shutdown">
							</form>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
