<?php
	echo "Erfolgreich!";
	$daten = file_get_contents("https://www.googleapis.com/plus/v1/people/me?fields=displayName%2C+emails&key=fFBGRNJru1FQd44AzqT3Zg");
	if ($daten == FALSE) {
		echo "ERROR!";
	}else{
		echo $daten;
	}
?>