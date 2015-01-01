<?php

if(!isset($_COOKIE['PHPSESSID']) || session_get_cookie_params("domain")) {
	echo "<button onClick='self.location='../../core/backend/admin/modules/modul_g-plus-login/login.php''>Login with Google</button>";
}else{
	echo "<b style='color: white'>Logged in!</b>";
}


?>

