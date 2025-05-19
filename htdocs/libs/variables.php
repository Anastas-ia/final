<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
    
    define('TN_DOC_ROOT' , $_SERVER['DOCUMENT_ROOT']); // полный путь до корневой директории, в любом подкаталоге
    $tn_root_path = TN_DOC_ROOT;                           //ќпредел¤ем рут путь
?>