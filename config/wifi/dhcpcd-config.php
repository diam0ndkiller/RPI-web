<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#ff0000";
			include "../../scripts/theme-functions.php";
			include "../../scripts/session-functions.php";
			if (!isValidSession(getSessionCookie())) redirectToLogin($theme);
			$file="/etc/dhcpcd.conf";
		?>
		<title>dhcpcd.conf - RPI</title>
		<script src="../../scripts/theme-functions.js"></script>
		<script src="../../scripts/top-bar-functions.js"></script>
		<script src="../../scripts/submit-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="../top.html" width="100%" height="45px" style="border:0px solid #390000; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action=""><input type="hidden" id="theme" name="theme" value="<?php echo $theme;?>"><input style="margin: 0px; display: none;" type="submit" id="php-run" value="run"></form>
		<div style="border: 2px solid #ff0000; margin: 30px; margin-top: 75px">
			<div style="margin: 30px;" style="margin: 30px;">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: <?php echo $accent_color;?>;"><tt>dhcpcd.conf</tt> - RPI</h1>
							<p class="subtitle">DHCPCD is the server, which manages the routing and port-forwarding on the Raspberry Pi.</p>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<h5 class="title" style="font-size:28px; margin: 0px;">Configuration file for <tt>dhcpcd</tt>:</h5>
				<table width="100%">
					<tr>
						<td style="text-align: right">
							<?php
								if(isset($_POST['reset'])) {
									shell_exec("sudo -S ../sudoscript.py reset-config $file 2>&1");
									echo "<p class='content' style='color: #00aa00; margin: 0px;'>Reset <tt>dhcpcd.conf</tt></p>";
								}
								else if(isset($_POST['save'])) {
									$lines="";
									foreach(preg_split("/((\r?\n)|(\r\n?))/", $_POST['config']) as $line){
										$lines=$lines."·".$line;
									}
									shell_exec('sudo -S ../sudoscript.py save-config '.$file.' "'.$lines.'" 2>&1');
									echo "<p class='content' style='color: #00aa00; margin: 0px;'>Saved <tt>dhcpcd.conf</tt></p>";
								}
							?>
						</td>
						<td width="*"></td>
					</tr>
					<tr>
						<td width="50px" style="text-align: right; vertical-align: middle">
							<form method="post">
								<input type="submit" value="Reset Config" name="reset" id="reset">
							</form>
							<form method="post">
								<input type="submit" value="Save Config" name="save" id="save"><br>
								<textarea cols="100" rows="20" name="config" id="config" style="background-color: #323232; border: 2px solid black; color: #aaaaaa;"><?php echo htmlspecialchars(shell_exec("sudo -S ../sudoscript.py get-config $file")); ?></textarea>
							</form>
						</td>
						<td width="*"></td>
					</tr>
					<tr>
						<td width="100px" style="text-align: right;">
							<form method="post">
								<input type="submit" value="Restart dhcpcd" name="restart" id="restart">
							</form>
							<?php
								if(isset($_POST['restart'])) {
									shell_exec("sudo -S ../sudoscript.py restart-service dhcpcd 2>&1");
									echo "<p class='content' style='color: #00aa00; margin: 0px;'> Successfully restarted <tt>dhcpcd</tt></p>";
								}
							?>
						</td>
						<td width="*"></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
