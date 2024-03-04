<?php
	if (isset($_GET['delete']) && $_GET['delete'] !== "") {
		shell_exec("sudo ./sudoscript.py delete '".$_GET['delete']."'");
	}
?>
