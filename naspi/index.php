<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<?php
			$accent_color = "#0088ff";
			include "../scripts/mimet-functions.php";
			include "../scripts/theme-functions.php";
			include "../scripts/path-functions.php";
		?>
		<title>share<?php echo $path?> - NASPI</title>
		<script src="../scripts/path-functions.js"></script>
		<script src="../scripts/theme-functions.js"></script>
		<script src="../scripts/top-bar-functions.js"></script>
		<script src="../scripts/submit-functions.js"></script>
	</head>
	<body>
		<iframe name="top" src="top.html" width="100%" height="45px" style="border:0px solid #0088ff; position:fixed; left:0px; top:0px; Z-Index:1;" onload="sendPath(this)">
		</iframe>
		<form style="margin: 0px;" method="get" action="">
			<script src="../scripts/delete-form.js"></script>
			<script src="../scripts/path-form.js"></script>
			<script src="../scripts/theme-form.js"></script>
			<script src="../scripts/submit-form.js"></script>
		</form>
		<div style="margin: 30px; margin-top: 75px; border: 2px solid #0088ff;">
			<div style="margin: 30px">
				<table width="100%">
					<tr>
						<td width="*">
							<h1 class="title" style="color: #0088ff;">NASPI</h1>
						</td>
						<td width="10px" style="text-align: center; vertical-align: middle; margin-left: 30px;">
							<script>drawThemeButton("#0088ff")</script>
						</td>
					</tr>
				</table>
				<p class="subtitle" style="margin: 0px">Welcome to the network attached storage server on my Raspberry Pi (<tt>naspi</tt>).</p>
				<h5 class="title">Upload Files</h5>
				<form method="post" action="" enctype="multipart/form-data">
					<input type="file" name="upload-files" id="upload-files">
					<input type="submit" name="upload" id="upload" value="Upload">
					<?php
						if(isset($_POST['upload'])) {
							echo "<pre>";
							print_r($_FILES["upload-files"]["error"]);
							echo "</pre>";
							echo shell_exec("sudo ./sudoscript.py copy ".$_FILES["upload-files"]["tmp_name"]." /srv/samba/share".$path . $_FILES["upload-files"]["name"]." 2>&1");
						}
					?>
				</form>
				<h5 class="title">Files</h5>
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
							<button onclick="pathUp();clickSubmitPhpButton()">Up</button>
						</td>
						<td style="text-align: right;" width="*">
							<form action="" method="post">
								<input type="submit" id="refresh" name="refresh" value="Refresh View">
							</form>
						</td>
						<td style="text-align: right;" width="*">
							<form action="player.php" method="get">
								<input type="hidden" name="path" value="<?php echo $path?>">
								<input type="hidden" name="theme" value="<?php echo $theme?>">
								<input type="submit" value="Open in Player">
							</form>
						</td>
					</tr>
				</table>
				<table width="100%" rule="all" cellspacing="0px">
					<?php
						if (isset($_POST['refresh'])) {
							$res = shell_exec("ls -1 'share".$path."' | sort 2>&1");
							$lst = explode("\n", $res);
							$mod = 0;
							foreach (array_values($lst) as $i => $val) {
								if ($val !== "") {
									$mod = $i%5;
									if ($mod == 0) { echo '<tr height="50px">'; }
									echo '<td align="center" style="vertical-align: bottom; border: 1px solid #777777;" width="20%">';
									if (is_dir("share".$path.$val)) {
										$val = $val."/";
										echo '<a href="javascript:setPath(\''.$path.$val.'\');javascript:clickSubmitPhpButton()"><img width="30%" src="folder.png" style="image-rendering: crisp-edges;"><br>'.$val.'</a></td>';
									}
									else if (strpos(get_mime_type($path.$val), "image/") !== false) {
										echo '<a target="_blank" href="share'.$path.$val.'"><img width="50%" src="share'.$path.$val.'"><br>'.$val.'</a></td>';
									} else {
										$file_type = 'file';
										foreach ($types as $type => $allowed) {
											if (is_file_type($path.$val, $allowed)) {
												$file_type = $type;
												break;
											}
										}
										echo '<a target="_blank" href="share'.$path.$val.'"><img width="30%" src="'.$file_type.'.png" style="image-rendering: crisp-edges;"><br>'.$val.'</a></td>';
									}
									if ($mod == 4) { echo "</tr>"; }
									else if ($i == count($lst)-2) {
										for ($i = $mod; $i < 4; $i++) {
											echo '<td width="20%">&nbsp;</td>';
										}
										echo "</tr>";
										break;
									}
								}
							}
						} else if (!isset($_FILES['upload-files']) || $_FILES['upload-files']['error'] == 0) { echo '<tr><td width="100%" style="text-align: center;"><tt>Loading...</tt></td></tr><script>clickRefreshButton()</script>'; }
					?>
				</table>
			</div>
		</div>
	</body>
</html>
