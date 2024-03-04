<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#0088ff";
			include "../scripts/theme-functions.php";
			include "../scripts/mimet-functions.php";
			include "../scripts/path-functions.php";
			include "../scripts/file-functions.php";
			include "../scripts/shuffle-functions.php";
			include "../scripts/repeat-functions.php";
			include "../scripts/current-time-functions.php";
			include "../scripts/volume-functions.php";
			include "../scripts/paused-functions.php";
		?>
		<title><?php if($file) echo explode("/", $file)[count(explode("/", $file))-1];?> - NASPI Media Player</title>
		<script src="../scripts/top-bar-functions.js"></script>
		<script src="../scripts/path-functions.js"></script>
		<script src="../scripts/file-functions.js"></script>
		<script src="../scripts/submit-functions-player.js"></script>
		<script src="../scripts/theme-functions.js"></script>
		<script src="../scripts/shuffle-functions.js"></script>
		<script src="../scripts/repeat-functions.js"></script>
		<script src="../scripts/current-time-functions.js"></script>
		<script src="../scripts/paused-functions.js"></script>
		<script src="../scripts/player-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="top.html" width="100%" height="45px" style="border:0px solid #0088ff; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action="">
			<script src="../scripts/file-form.js"></script>
			<script src="../scripts/current-time-form.js"></script>
			<script src="../scripts/path-form.js"></script>
			<script src="../scripts/shuffle-form.js"></script>
			<script src="../scripts/repeat-form.js"></script>
			<script src="../scripts/theme-form.js"></script>
			<script src="../scripts/volume-form.js"></script>
			<script src="../scripts/paused-form.js"></script>
			<script src="../scripts/submit-form.js"></script>
		</form>
		<div style="margin: 30px; margin-top: 75px; border: 2px solid #0088ff;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: #0088ff;">NASPI - Media Player</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: middle; margin-left: 30px;">
							<script>drawThemeButton(accent_color)</script>
						</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td width="50%" style="vertical-align: top;">
							<p class="subtitle" style="margin: 0px">Welcome to the media player of the NAS on my Raspberry Pi (<tt>naspi</tt>).</p>
							<table width="100%" style="margin-top: 30px;">
								<tr>
									<td width="*">
										<script>buildPlayer()</script>
									</td>
									<td width="10px" style="text-align: center; vertical-align: bottom; margin-left: 30px;">
										<button style="font-size: 20px;" id="play_button" onclick="togglePause()"><p style="margin: 10px">▶️</p></button>
									</td>
									<script>loadPlayerEvents()</script>
									<td width="10px" style="text-align: right; vertical-align: bottom; margin-left: 30px;">
										<?php
											echo '<button onclick="playNext(1);clickSubmitPhpButtonVanilla()"><p style="font-size: 20px; margin: 10px;" >⏭️</p></button>';
										?>
									</td>
									<td width="10px" style="text-align: center; vertical-align: bottom; margin-left: 30px;">
										<?php
											$args="font-size: 20px;";
											if ($repeat == "true") $args = $args." background-color: #0088ff;";
											echo '<button style="'.$args.'" onclick="toggleRepeat();clickSubmitPhpButton()"><p style="margin: 10px">🔂</p></button>';
										?>
									</td>
									<td width="10px" style="text-align: center; vertical-align: bottom; margin-left: 30px;">
										<?php
											$args="font-size: 20px;";
											if ($shuffle == "true") $args = $args." background-color: #0088ff;";
											echo '<button style="'.$args.'" onclick="toggleShuffle();clickSubmitPhpButton()"><p style="margin: 10px;">🔀</p></button>';
										?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td width="50%" style="text-align: left; vertical-align: top;">
							<h5 class="title">Playlist</h5>
						</td>
						<td>
							<h5 class="title">Files</h5>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; vertical-align: top;">
							<table>
								<tr>
									<td>
										<p class="subtitle" style="margin: 0px; margin-right: 50px;">Playing: <b><?php if($file) echo explode("/", $file)[count(explode("/", $file))-1];?></b></p>
									</td>
									<td width="'">
									</td>
								</tr>
							</table>
							<?php //echo '<img src="'.$file.'" width="50%">';?>
						</td>
						<td width="50%" style="text-align: left; vertical-align: top;">
							<table>
								<tr>
									<td>
										<p class="subtitle" style="margin: 0px; margin-right: 50px;">Location: <tt>
											<?php
												echo '<a href="javascript:setPath(\'/\');javascript:clickSubmitPhpButton()">share</a>/';
												$splitPath = "/";
												foreach (explode("/", $path) as $i) {
													if ($i !== "") {
														$splitPath = $splitPath.$i."/";
														echo '<a href="javascript:setPath(\''.$splitPath.'\');javascript:clickSubmitPhpButton()">'.$i.'</a>/';
													}
												}
											?>
										</tt></p>
									</td>
									<td>
										<?php echo '<button onclick="javascript:pathUp();javascript:clickSubmitPhpButton()" id="go-up">';?>Up</button>
									</td>
									<td style="text-align: right;" width="*">
										<?php echo '<button onclick="javascript:clickSubmitPhpButton()" id="refresh">';?><nobr>Refresh View<nobr></button>
									</td>
									<td style="text-align: right;" width="*">
										<form action="index.php" method="get">
											<input type="hidden" name="path" value="<?php echo $path?>">
											<input type="hidden" name="theme" value="<?php echo $theme?>">
											<input type="submit" value="Open in Folder View">
										</form>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; vertical-align: top;">
							<table width="100%" rule="all" cellspacing="0px">
								<?php
									foreach (array_values($files) as $i => $val) {
										if ($val !== "") {
											echo '<tr height="30px">';
											echo '<td width="1px" align="left" style="vertical-align: middle; font-size: 30px; border: 1px solid #777777;">';
											if (strpos(get_mime_type($val), "audio/") !== false) {
												echo '<img width="30px" src="audio.png" style="image-rendering: crisp-edges;"></td><td width="*" style="vertical-align: middle; border: 1px solid #777777;"><a href="javascript:playNext('.$i.')">share'.$val.'</a></td>';
											} else if (strpos(get_mime_type($val), "video/") !== false) {
												echo '<img width="30px" src="video.png" style="image-rendering: crisp-edges;"></td><td width="*" style="vertical-align: middle; border: 1px solid #777777;"><a href="javascript:playNext('.$i.')">share'.$val.'</a></td>';
											}
											echo "</tr>";
										}
									}
								?>
							</table>
							<?php if ($audio_file) echo '<div width="100%" style="margin: 10px;"><iframe width="100%" height="500px" src="https:/www.lyricsmania.com/search.php?k='.$clean_file_name_eval.'" style="border: solid #888888 1px;"></iframe></div>';?>
						</td>
						<td style="text-align: left; vertical-align: top;">
							<table width="100%" rule="all" cellspacing="0px" id="file_list">
								<?php
									$res = shell_exec("ls -1 'share".$path."' | sort 2>&1");
									$lst = explode("\n", $res);
									$mod = 0;
									$shuffleFile = "";
									while ($files_str == "" && $shuffle == "true" && $shuffleFile == "") {
										$shuffleFile = $path.$lst[array_rand($lst)];
										if (!is_dir("share".$shuffleFile) && (strpos(get_mime_type("share".$shuffleFile), "audio/") !== false || strpos(get_mime_type("share".$shuffleFile), "video/") !== false)) echo '<script>setFile("'.$shuffleFile.'");clickSubmitPhpButtonVanilla()</script>';
										else $shuffleFile = "";
									}
									foreach (array_values($lst) as $i => $val) {
										$eval=str_replace("'", "\\'", str_replace('"', '\\"', $val));
										if ($val !== "") {
											if (is_dir("share".$path.$val)) {
												$val = $val."/";
												$eval = $eval."/";
												echo '<tr height="30px">';
												echo '<td width="1px" align="left" style="vertical-align: middle; font-size: 30px; border: 1px solid #777777;">';
												echo '<img height="30px" src="folder.png" style="image-rendering: crisp-edges;"></td><td width="*" style="vertical-align: middle; border: 1px solid #777777;"><a href="javascript:setPath(\''.$path.$eval.'\');javascript:clickSubmitPhpButton()">'.$val.'</a></td>';
												echo "</tr>";
											} else if (strpos(get_mime_type("share".$path.$val), "audio/") !== false) {
												echo '<tr height="30px">';
												echo '<td width="1px" align="left" style="vertical-align: middle; font-size: 30px; border: 1px solid #777777;">';
												echo '<img width="30px" src="audio.png" style="image-rendering: crisp-edges;"></td><td width="*" style="vertical-align: middle; border: 1px solid #777777;"><a href="javascript:setFile(\''.$path.$eval.'\');javascript:clickSubmitPhpButtonVanilla()">'.$val.'</a> [<a style="text-align: right;" href="javascript:setFile(\''.$files_str_eval.':'.$path.$eval.'\');javascript:clickSubmitPhpButton()">append</a>] [<a style="text-align: right;" href="javascript:setFile(\''.$path.$eval.':'.$files_str_eval.'\');javascript:clickSubmitPhpButtonVanilla()">next</a>]</td>';
												echo "</tr>";
											} else if (strpos(get_mime_type("share".$path.$val), "video/") !== false) {
												echo '<tr height="30px">';
												echo '<td width="1px" align="left" style="vertical-align: middle; font-size: 30px; border: 1px solid #777777;">';
												echo '<img width="30px" src="video.png" style="image-rendering: crisp-edges;"></td><td width="*" style="vertical-align: middle; border: 1px solid #777777;"><a href="javascript:setFile(\''.$path.$eval.'\');javascript:clickSubmitPhpButtonVanilla()">'.$val.'</a> [<a style="text-align: right;" href="javascript:setFile(\''.$files_str_eval.':'.$path.$eval.'\');javascript:clickSubmitPhpButton()">append</a>] [<a style="text-align: right;" href="javascript:setFile(\''.$path.$eval.':'.$files_str_eval.'\');javascript:clickSubmitPhpButtonVanilla()">next</a>]</td>';
												echo "</tr>";
											}
										}
									}
								?>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
