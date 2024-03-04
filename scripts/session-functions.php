<?php
	function generateSessionKey() {
		// Generate a session key
		$datetime = date('YmdHis');
		$random_number = mt_rand(10000, 99999); // Generates a random 8-digit number
		$session_key = $datetime . $random_number;
		return $session_key;
	}

	function writeSessionCookie($session_key) {
		// Set a cookie with the session key
		setcookie('session', $session_key, time() + 3600*24*100, '/');
	}

	function enableSessionKey($session_key) {
		// Define the file path (use an absolute path)
		$file_path = '/var/www/sessions.txt'; // Replace with the actual path

		// Append the session key to the file
		file_put_contents($file_path, $session_key . PHP_EOL, FILE_APPEND);
	}

	function getSessionCookie() {
		if (isset($_COOKIE['session'])) return $_COOKIE['session'];
		else return '';
	}

	function isValidSession($session_key) {
		$file_path = '/var/www/sessions.txt'; // Replace with the actual path
		$session_keys = file($file_path, FILE_IGNORE_NEW_LINES);
		foreach ($session_keys as $key) {
			if ($session_key === $key) {
				return true;
			}
		}
		return false;
	}

	function redirectToLogin($theme) {
		header("Location: /config/login.php?theme=$theme&redirect=" . urlencode($_SERVER['REQUEST_URI']));
	}

	function deleteSessionCookie() {
		setcookie('session', '', time() - 3600, '/');
	}

	function disableSessionKey($session_key_to_remove) {
		$file_path = '/var/www/sessions.txt'; // Replace with the actual path
		$session_keys = file($file_path, FILE_IGNORE_NEW_LINES);

		// Filter out the session key to remove
		$session_keys = array_filter($session_keys, function($key) use ($session_key_to_remove) {
			return $key !== $session_key_to_remove;
		});

		// Write the remaining session keys back to the file
		file_put_contents($file_path, implode("\n", $session_keys));
	}
?>
