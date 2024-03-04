<?php
	if (isset($_GET['file']) && $_GET['file'] !== "") {
		$files_str = $_GET['file'];
		$files = explode(":", $files_str);
		$file = $files[0];
		$file_eval=str_replace("'", "\\'", str_replace('"', '\\"', $file));
		$files_str_eval=str_replace("'", "\\'", str_replace('"', '\\"', $files_str));
		$clean_file_name=explode(".", explode("/",$file)[count(explode("/", $file))-1])[0];
		$clean_file_name_eval=str_replace("&", "and", $clean_file_name);
	} else $files=$file="";
	echo '<script>files_str="'.$files_str.'";file="'.$file.'";clean_file_name="'.$clean_file_name.'"</script>';

	if (strpos(get_mime_type($file), "audio/") !== false) $audio_file = true;
	else $audio_file = false;
	if (strpos(get_mime_type($file), "video/") !== false) $video_file = true;
	else $video_file = false;
	if ($audio_file) echo '<script>audio_file=true</script>';
	else echo '<script>audio_file=false</script>';
	if ($video_file) echo '<script>video_file=true</script>';
	else echo '<script>video_file=false</script>';
?>
