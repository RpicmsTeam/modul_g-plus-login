<?php

include($root.'/core/libs/OAuth2/vendor/autoload.php');
use fkooman\OAuth\Client\Api;
use fkooman\OAuth\Client\Context;
use fkooman\OAuth\Client\GoogleClientConfig;
use fkooman\OAuth\Client\SessionStorage;

$googleClientConfig = new GoogleClientConfig(
    json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true)
);
$api = new Api("foo", $googleClientConfig, new SessionStorage(), new \Guzzle\Http\Client());
$context = new Context("mtrnord1@gmail.com", array("https://www.googleapis.com/auth/plus.login"));
$accessToken = $api->getAccessToken($context);


if(!isset($_COOKIE['PHPSESSID']) || !$_COOKIE['PHPSESSID'] == $accessToken) {
	echo "<button onClick=\"self.location='../../core/backend/admin/modules/modul_g-plus-login/login.php'\">Login with Google</button>";
}else{
	echo "<b style='color: white'>Logged in!</b>";
	echo "Value is: " . $_COOKIE['PHPSESSID'];
}


?>

