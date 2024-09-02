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
		<title>Clients - RPI</title>
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
							<h1 class="title" style="color: <?php echo $accent_color;?>;">Clients - RPI</h1>
							<p class="subtitle" style="margin: 0px">Active clients on the WiFi network (<tt>hostapd</tt>) are blocked from internet usage by default (<tt>iptables</tt>).</p>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td>
							<h5 class="title" style="font-size:28px; margin: 0px;">List of active / unlocked clients:</h5>
						</td>
						<td style="text-align: right; vertical-align: middle">
							<form method="post">
								<input type="submit" value="Refresh list" name="refresh" id="refresh">
							</form>
						</td>
					</tr>
				</table>
				<form method="post" action="">
					<?php
						if(isset($_POST['update'])) {
							$str = shell_exec("sudo -S ../sudoscript.py get-active-ips 2>&1");
							$clients = explode("\n", $str);
							foreach ($clients as $line) {
								$ip =  explode(" ", $line)[0];
								if (isset($_POST[str_replace(".", "_",$ip)])) {
									shell_exec("sudo -S ../sudoscript.py add-allow-ip ".$ip." 2>&1");
								} else {
									shell_exec("sudo -S ../sudoscript.py remove-allow-ip ".$ip." 2>&1");
								}
							}
							shell_exec("sudo -S ../sudoscript.py allow-iptables");
						}
						if(isset($_POST['disable'])) {
							shell_exec("sudo -S ../sudoscript.py disable-allow-ips");
						}
						if(isset($_POST['enable'])) {
							shell_exec("sudo -S ../sudoscript.py enable-allow-ips");
						}
						$str = shell_exec("sudo -S ../sudoscript.py get-active-ips 2>&1");
						$clients = explode("\n", $str);
						echo "<table style=\"width:50%; background-color: #323232; color: #aaaaaa; border: 1px solid black;\"><thead style=\"font-weight:bold;\"><td>IP</td><td>Name</td><td>Status</td><td>Unlocked</td></thead>";
						foreach ($clients as $line) {
							$info = explode(" ", $line);
							echo "<tr>";
							$ip = str_replace(".", "_", $info[0]);
							foreach ($info as $i) {
								if ($i == "blocked") {
									echo "<td><input type=\"checkbox\" id=\"$ip\" name=\"$ip\"></td>";
								} else if ($i == "unlocked") {
									echo "<td><input type=\"checkbox\" id=\"$ip\" name=\"$ip\" checked></td>";
								} else {
									echo "<td>$i</td>";
								}
							}
							echo "</tr>";
						}
						echo "</table>";
					?>
					<table width="100%" style="margin-top: 10px; text-align: right">
						<tr>
							<td width="*">
								<pre>
									<?php
										$str = shell_exec("sudo -S ../sudoscript.py get-iptables-forward-rules 2>&1");
										echo "$str";
									?>
								</pre>
							</td>
							<td>
								<?php
									if(isset($_POST['update'])) {
										echo "<p class='content' style='color: #00aa00; margin: 0px;'> Successfully updated <tt>iptables</tt>-policies</p>";
									}
									if(isset($_POST['enable'])) {
										echo "<p class='content' style='color: #00aa00; margin: 0px;'> Successfully enabled <tt>iptables</tt> client blocking</p>";
									}
									if(isset($_POST['disable'])) {
										echo "<p class='content' style='color: #00aa00; margin: 0px;'> Successfully disabled <tt>iptables</tt> client blocking</p>";
									}
								?>
							</td>
							<td width="100px">
								<nobr>
									<input type="submit" value="Update iptables-Policies" name="update" id="update">
									<input type="submit" value="Disable" name="disable" id="disable">
									<input type="submit" value="Enable" name="enable" id="enable">
								</nobr>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
