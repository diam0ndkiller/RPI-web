<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="icon" href="/favicon.png" type="image/png">
		<?php
			$accent_color = "#ff0000";
			include "../scripts/theme-functions.php";
			include "../scripts/session-functions.php";
			if (isset($_GET['redirect']) && $_GET['redirect'] !== "") $redirect = $_GET['redirect'];
			else $redirect = "/config/";
		?>
		<title>Login - dia</title>
		<script src="../scripts/theme-functions.js"></script>
		<script src="../scripts/submit-functions.js"></script>
	</head>
	<body style="margin: 0;">
		<form style="margin: 0px;" method="get" action="">
			<script src="../scripts/theme-form.js"></script>
			<input type="hidden" id="redirect" name="redirect" value="<?php echo $redirect;?>"/>
			<script src="../scripts/submit-form.js"></script>
		</form>
		<div style="margin: 30px; border: 2px solid <?php echo $accent_color;?>;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*" style="vertical-align:top;">
							<h1 class="title" style="color: <?php echo $accent_color;?>;">Login - <tt>rpi</tt> configuration sites</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: top; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table><pre>
<?php
					if (isset($_GET['logout'])) {
						$sessionKey = getSessionCookie();
						echo "logged out ".$sessionKey;
						disableSessionKey($sessionKey);
						deleteSessionCookie();
                        header("Location: /?theme=$theme");
					}
					if (isset($_POST['username']) && isset($_POST['password'])) {
						$username = $_POST['username'];
						$password = $_POST['password'];

						// Read the users.txt file
						$file_path = '/var/www/users.txt'; // Replace with the actual path
						$user_data = file($file_path, FILE_IGNORE_NEW_LINES);

						// Loop through the user data and check for a match
						foreach ($user_data as $line) {
							list($stored_username, $stored_password) = explode('=', $line);
							if ($username == $stored_username && $password == $stored_password) {
								$sessionKey = generateSessionKey();
								writeSessionCookie($sessionKey);
								enableSessionKey($sessionKey);
								header("Location: ".$redirect);
								exit();
							}
						}
						echo "Login failed.";
					}
				?></pre>
				<form method="POST" action="">
					Username: <input type="text" id="username" name="username" label="Username: "/>
					Password: <input type="password" id="password" name="password" label="Password: "/>
					<input type="submit" id="submit-login" name="submit-login" value="Login"/>
				</form>
			</div>
		</div>
	</body>
</html>
