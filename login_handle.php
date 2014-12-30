<?php
	echo "Erfolgreich!";
	$daten = file_get_contents("https://www.googleapis.com/plus/v1/people/me?fields=displayName%2C+emails&key=1/AIzaSyDBD8zf8MBMMu4aAbsK5Z4-83aoLkhqNvE");
	if ($daten == FALSE) {
		echo "ERROR!";
	}else{
		echo $daten;
	}
?>