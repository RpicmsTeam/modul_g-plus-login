<?php

if(!isset($_COOKIE['PHPSESSID'])) {
	echo "<button onClick='self.location='../../core/backend/admin/modules/modul_g-plus-login/login.php''>Login with Google</button>";
}else{
	echo "<b style='color: white'>Logged in!</b>";
	echo "Value is: " . $_COOKIE[$cookie_name];
}


?>

