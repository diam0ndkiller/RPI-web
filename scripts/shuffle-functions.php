<?php
	if (isset($_GET['shuffle']) && $_GET['shuffle'] !== "") {
		$shuffle = $_GET['shuffle'];
	} else $shuffle="false";
	echo '<script>shuffle='.$shuffle.'</script>';
?>
