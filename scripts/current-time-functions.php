<?php
	if (isset($_GET['current_time']) && $_GET['current_time'] !== "") {
		$current_time = $_GET['current_time'];
	} else $current_time=0;
	echo '<script>current_time='.$current_time.'</script>';
?>
