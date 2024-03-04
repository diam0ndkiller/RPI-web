<?php 
	if (isset($_GET['theme'])) $theme = $_GET['theme'];
	else $theme="light";
	if ($theme=="dark") echo '<style type="text/css">@import "/style/style-dark.css";button:hover, input:hover {background-color: #444444;}; button:active, input:active {background-color: '.$accent_color.';}</style>';
	else echo '<style type="text/css">@import "/style/style.css";button:hover, input:hover {background-color: #aaaaaa;}; button:active, input:active {background-color: '.$accent_color.';}</style>';
	echo '<script>theme="'.$theme.'";accent_color="'.$accent_color.'"</script>';
?>
