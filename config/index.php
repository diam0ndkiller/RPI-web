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
		<title>Config - RPI</title>
		<script src="../scripts/theme-functions.js"></script>
		<script src="../scripts/top-bar-functions.js"></script>
		<script src="../scripts/submit-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="top.html" width="100%" height="45px" style="border:0px solid #390000; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action=""><input type="hidden" id="theme" name="theme" value="<?php echo $theme;?>"><input style="margin: 0px; display: none;" type="submit" id="php-run" value="run"></form>
		<div style="margin: 30px; margin-top: 75px; border: 2px solid #ff0000;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: <?php echo $accent_color;?>;">Config - RPI</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<p class="subtitle" style="margin: 0px">Configuration of Services on my Raspberry Pi.</p>
				<h5 class="title">Actions</h5>
				<table style="vertical-align: middle">
					<tr>
						<td>
							<form method="post" action="">
								<input type="submit" value="Reboot RPI" name="reboot" id="reboot">
							</form>
						</td>
						<td>
							<form method="post" action="">
								<input type="submit" value="Shutdown RPI" name="shutdown" id="shutdown">
							</form>
						</td>
						<td>
							<?php
								if(isset($_POST['reboot'])) {
									echo "<p class='content' style='color: #aaaa00; margin: 0px;'> Rebooting (please refresh in a few moments)";
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
					</tr>
				</table>
				<h5 class="title">Quick Links</h5>
				<ul class="content second">
					<li><a href="status.php?theme=<?php echo $theme;?>">System Load (<tt>top</tt>)</a></li>
					<li><a href="apache2-config.php?theme=<?php echo $theme;?>"><tt>apache2.conf</tt></a></li>
					<li><a href="smbd-config.php?theme=<?php echo $theme;?>"><tt>smb.conf</tt></a></li>
					<li><a href="wifi/index.php?theme=<?php echo $theme;?>">Internet / WLAN Settings</a></li>
					<ul class="content third">
						<li><a href="wifi/status.php?theme=<?php echo $theme;?>">Connection Status</a></li>
						<li><a href="wifi/network-traffic.php?theme=<?php echo $theme;?>">Network Traffic</a></li>
						<li><a href="wifi/clients.php?theme=<?php echo $theme;?>">Active / unlocked Clients</a></li>
						<li><a href="wifi/hostapd-config.php?theme=<?php echo $theme;?>"><tt>hostapd.conf</tt></a></li>
						<li><a href="wifi/dnsmasq-config.php?theme=<?php echo $theme;?>"><tt>dnsmasq.conf</tt></a></li>
						<li><a href="wifi/dhcpcd-config.php?theme=<?php echo $theme;?>"><tt>dhcpcd.conf</tt></a></li>
					</ul>
				</ul>
			</div>
		</div>
	</body>
</html>
