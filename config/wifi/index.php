<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#ff0000";
			include "../../scripts/theme-functions.php";
			include "../../scripts/session-functions.php";
			if (!isValidSession(getSessionCookie())) redirectToLogin($theme);
		?>
		<title>WiFi - Administrative Pages - RPI</title>
		<script src="../../scripts/theme-functions.js"></script>
		<script src="../../scripts/top-bar-functions.js"></script>
		<script src="../../scripts/submit-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="../top.html" width="100%" height="45px" style="border:0px solid #390000; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action=""><input type="hidden" id="theme" name="theme" value="<?php echo $theme;?>"><input style="margin: 0px; display: none;" type="submit" id="php-run" value="run"></form>
		<div style="margin: 30px; margin-top: 75px; border: 2px solid #ff0000;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: <?php echo $accent_color;?>;">WLAN Router - RPI</h1>
							<p class="subtitle">Information and configuration for the RPI's WLAN router.</p>
				            <p>The router on the raspberrypi runs using three services: <tt>hostapd</tt>, a wifi acces point server, <tt>dnsmasq</tt>, a dns and dhcp server and <tt>dhcpcd</tt> for the routing.</p>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<h5 class="title">Actions</h5>
				<table style="vertical-align: middle">
					<tr>
						<td>
							<form method="post" action="">
								<input type="submit" value="Restart hostapd" name="restart" id="restart">
							</form>
						</td>
						<td>
							<form method="post" action="">
								<input type="submit" value="Reboot RPI" name="reboot" id="reboot">
							</form>
						</td>
						<td>
							<form method="post" action="">
								<input type="submit" value="Shut Down RPI" name="shutdown" id="shutdown">
							</form>
						</td>
						<td>
							<?php
								if(isset($_POST['reboot'])) {
									echo "<p class='content' style='color: #aaaa00; margin: 0px;'> Rebooting (please refresh in a few moments)";
									shell_exec("sudo -S ../sudoscript.py reboot 2>&1");
								}
								if(isset($_POST['shutdown'])) {
									echo "<p class='content' style='color: #aaaa00; margin: 0px;'> Shutting Down";
									shell_exec("sudo -S ../sudoscript.py shutdown 2>&1");
								}
								if(isset($_POST['restart'])) {
									shell_exec("sudo -S ../sudoscript.py restart-service hostapd 2>&1");
									echo "<p class='content' style='color: #00aa00; margin: 0px;'> Successfully restarted <tt>hostapd</tt></p>";
								}
							?>
						</td>
					</tr>
				</table>
				<h5 class="title">Quick Links</h5>
				<ul class="content second">
					<li><a href="status.php?theme=<?php echo $theme;?>">Connection Status</a></li>
					<li><a href="network-traffic.php?theme=<?php echo $theme;?>">Network Traffic</a></li>
					<li><a href="clients.php?theme=<?php echo $theme;?>">Active / unlocked Clients</a></li>
					<li><a href="hostapd-config.php?theme=<?php echo $theme;?>"><tt>hostapd.conf</tt></a></li>
					<li><a href="dnsmasq-config.php?theme=<?php echo $theme;?>"><tt>dnsmasq.conf</tt></a></li>
					<li><a href="dhcpcd-config.php?theme=<?php echo $theme;?>"><tt>dhcpcd.conf</tt></a></li>
				</ul>
			</div>
		</div>
	</body>
</html>
