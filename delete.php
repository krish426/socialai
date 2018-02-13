<?php
	$id = (string)$_POST['id'];
 	$fileName = 'inc/nxs-functions-'.$id.'.php';
	echo unlink($fileName);
	
	$fileName = $id.'-nx-snap-settings.php';
	echo unlink($fileName);
?>