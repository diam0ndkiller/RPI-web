<?php
	if (isset($_GET['sortby'])) {
		$sortby = $_GET['sortby'];
	} else {
		$sortby = "title";
	}
    if (isset($_GET['sortdir'])) {
        $sortdir = $_GET['sortdir'];
    } else {
        $sortdir = "asc";
    }
	echo '<script>sortby="'.$sortby.'";sortdir="'.$sortdir.'"</script>';
?>
