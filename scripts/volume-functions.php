<?php
	if (isset($_GET['volume']) && $_GET['volume'] !== "") {
		$volume = $_GET['volume'];
	} else $volume=1;
	echo '<script>volume='.$volume.'</script>';
?>
