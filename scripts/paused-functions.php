<?php
	if (isset($_GET['paused']) && $_GET['paused'] !== "") {
		$paused = $_GET['paused'];
	} else $paused="false";
	echo '<script>paused='.$paused.'</script>';
?>
