<?php
	function get_mime_type($filename) {
		$idx = explode( '.', $filename );
		$count_explode = count($idx);
		$idx = strtolower($idx[$count_explode-1]);

		$mimet = array( 
			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'text/javascript',
			'py' => 'application/python',
			'sh' => 'application/bash',
			'bat' => 'application/batch',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'wav' => 'audio/mpeg',
			'ogg' => 'audio/mpeg',
			'mp4' => 'video/mp4',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',
			'docx' => 'application/msword',
			'xlsx' => 'application/vnd.ms-excel',
			'pptx' => 'application/vnd.ms-powerpoint',


			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
			'odp' => 'application/vnd.oasis.opendocument.presentation'
		);

		if (isset( $mimet[$idx] )) {
		 return $mimet[$idx];
		} else {
		 return $idx;
		}
	}

	$types = array(
		'audio' => array('audio/mpeg'),
		'video' => array('video/quicktime', 'video/mp4'),
		'document' => array('text/plain', 'application/msword', 'application/vnd.oasis.opendocument.text', 'text/rtf'),
		'table' => array('csv', 'application/vnd.ms-excel', 'application/vnd.oasis.opendocument.spreadsheet'),
		'presentation' => array('application/vnd.ms-powerpoint', 'application/vnd.oasis.opendocument.presentation'),
		'pdf' => array('application/pdf'),
		'mindmap' => array('mm'),
		'web' => array('text/html'),
		'script' => array('application/bash', 'application/batch'),
		'graphic' => array('xcf', 'odg'),
		'math-system' => array('ggb'),
		'midi' => array('midi', 'mscz'),
		'data-script' => array('application/json', 'application/xml', 'yml', 'dat', 'cfg'),
		'script-file' => array('text/css', 'text/javascript', 'application/python'),
		'calendar' => array('ics'),
	);

	function is_file_type($file, $allowed) {
		$type=get_mime_type($file);
		if( in_array($type, $allowed) ) {
			return true;
		} else {
			return false;
		}
	}
?>
