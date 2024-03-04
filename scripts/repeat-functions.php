<?php
	if (isset($_GET['repeat']) && $_GET['repeat'] !== "") {
		$repeat = $_GET['repeat'];
	} else $repeat="false";
	echo '<script>repeat='.$repeat.'</script>';
?>
