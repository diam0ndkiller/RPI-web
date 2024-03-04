<?php
	if (isset($_GET['search']) && $_GET['search'] !== "") {
		$searching = true;
		$search = $_GET['search'];
		echo '<script>searching=true';
	} else {
		$searching = false;
		$search = "";
		echo '<script>searching=false';
	}
	if (isset($_GET['id']) && $_GET['id'] !== '') {
		$id = $_GET['id'];
		$id_search = true;
	} else {
		$id = '';
		$id_search = false;
	}
	echo ';search="'.$search.'";id="'.$id.'"</script>';
?>
