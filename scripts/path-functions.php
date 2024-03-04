<?php
	if (isset($_GET['path'])) {
		$path = $_GET['path'];
	} else $path="/";
	echo '<script>path="'.$path.'"</script>';
?>
