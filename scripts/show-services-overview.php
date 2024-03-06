<td class="o" width="50%" style="vertical-align:top;">
	<h2 style="text-align: center">Services</h2>
	<div class="b">
		<h3>Internet Status</h3>
		<?php
			$active_clients = 0;
			$active_blocked_clients = 0;
			$active_unlocked_clients = 0;
			$inactive_unlocked_clients = 0;
			if (strpos(shell_exec("sudo -S config/sudoscript.py internet-connection 2>&1"), "True") !== false) echo "<p class=true>Server Connected to the Internet.</p>";
			else echo "<p class=false>Server Internet Connection Failed.</p>";
			$client_ip = $_SERVER["REMOTE_ADDR"];
			$str = shell_exec("sudo -S config/sudoscript.py get-active-ips 2>&1");
			$clients = explode("\n", $str);
			foreach ($clients as $client) {
				if ($client == "") continue;
				$info = explode(" ", $client);
				if ($info[0] == $client_ip) {
					if ($info[3] == "blocked") echo "<p class=false><tt>Your Device ($client_ip) is Blocked from Internet Usage.</tt></p>";
					else echo "<p class=true>Your Device ($client_ip) is Connected to the Internet.</p>";
				}
				if ($info[2] == "active") {
					$active_clients = $active_clients + 1;
					if ($info[3] == "unlocked") $active_unlocked_clients += 1;
					else $active_blocked_clients += 1;
				} else $inactive_unlocked_clients += 1;
			}
		?>
	</div>
	<div class="b">
		<h3>Router Status</h3>
		<?php
			$hostapd_state = shell_exec("sudo -S config/sudoscript.py get-service-state hostapd 2>&1");
			$dnsmasq_state = shell_exec("sudo -S config/sudoscript.py get-service-state dnsmasq 2>&1");
			$dhcpcd_state = shell_exec("sudo -S config/sudoscript.py get-service-state dhcpcd 2>&1");
			$iftop_state = shell_exec("sudo -S config/sudoscript.py get-service-state iftop-rpi-service 2>&1");
			$hostapd_active = $hostapd_state == "active\n";
			$dnsmasq_active = $dnsmasq_state == "active\n";
			$dhcpcd_active = $dhcpcd_state == "active\n";
			if ($hostapd_active) echo "<p class=true><a href=\"config/wifi/hostapd-config.php?theme=$theme\">hostapd</a> Server Running.</p>";
			else echo "<p class=false><a href=\"config/wifi/hostapd-config.php?theme=$theme\">hostapd</a> Daemon has state $hostapd_state.</p>";
			if ($dnsmasq_active) echo "<p class=true><a href=\"config/wifi/dnsmasq-config.php?theme=$theme\">dnsmasq</a> Server Running.</p>";
			else echo "<p class=false><a href=\"config/wifi/dnsmasq-config.php?theme=$theme\">dnsmasq</a> Daemon has state $dnsmasq_state.</p>";
			if ($dhcpcd_active) echo "<p class=true><a href=\"config/wifi/dhcpcd-config.php?theme=$theme\">dhcpcd</a> Server Running.</p>";
			else echo "<p class=false><a href=\"config/wifi/dhcpcd-config.php?theme=$theme\">dhcpcd</a> Daemon has state $dhcpcd_state.</p>";
			if ($iftop_state == "active\n") echo "<p class=true><a href=\"config/wifi/network-traffic.php?theme=$theme\">iftop</a> Daemon Running.</p>";
			else echo "<p class=false><a href=\"config/wifi/network-traffic.php?theme=$theme\">iftop</a> Daemon has state $iftop_state.</p>";
		?>
		<p class="config"><a href="config/wifi/?theme=<?php echo $theme;?>">Router Settings (restricted)</a></p>
	</div>
	<div class="b">
		<h3>WiFi Clients</h3>
		<?php
			if ($hostapd_active && $dnsmasq_active) {
				echo "<p class=\"true\">WiFi active</p>";
				echo "<p class=\"green\">active unlocked clients: $active_unlocked_clients</p>";
				echo "<p class=\"green\">active blocked clients: $active_blocked_clients</p>";
			} else {
				echo "<p class=\"false\">WiFi inactive</p>";
			}
			echo "<p class=\"aqua\">total unlocked clients: ".($inactive_unlocked_clients+$active_unlocked_clients)."</p>";
		?>
		<p class="config"><a href="config/wifi/clients.php?theme=<?php echo $theme;?>">Manage Clients (restricted)</a></p>
	</div>
	<div class="b">
		<h3>HTTP Server Status</h3>
		<?php
			if (shell_exec("sudo -S config/sudoscript.py get-service-state apache2 2>&1") == "active\n") echo "<p class=true><a href=\"config/apache2-config.php?theme=$theme\">apache2</a> Server Running.</p>";
			else echo "<p class=false><a href=\"config/apache2-config.php?theme=$theme\">apache2</a> Daemon has state ".shell_exec("sudo -S config/sudoscript.py get-service-state apache2 2>&1").".</p>";
		?>
		<p class="raspi"><a href="phpinfo.php">PHP info page</a></p>
		<p class="raspi"><a href="apacheindex.html">Apache Index Page</a></p>
	</div>
	<div class="b">
		<h3>File Server Status</h3>
		<?php
			if (shell_exec("sudo -S config/sudoscript.py get-service-state smbd 2>&1") == "active\n") echo "<p class=true><a href=\"config/smbd-config.php?theme=$theme\">smbd</a> Server Running.</p>";
			else echo "<p class=false><a href=\"config/smbd-config.php?theme=$theme\">smbd</a> Daemon has state ".shell_exec("sudo -S config/sudoscript.py get-service-state smbd 2>&1").".</p>";
		?>
		<p class="naspi"><a href="naspi/?theme=<?php echo $theme;?>">Browse Network Attached Storage</a></p>
	</div>
	<div class="b">
		<h3>Config</h3>
		<p class="config"><a href="config/?theme=<?php echo $theme;?>">Configuration (restricted)</a></p>
		<p class="config"><a href="config/wifi?theme=<?php echo $theme;?>">Network Configuration (restricted)</a></p>
	</div>
</td>
