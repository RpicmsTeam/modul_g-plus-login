<?php
$old_error_reporting = error_reporting(0);
###############################
# include files from root dir #
###############################
$root_1 = realpath($_SERVER["DOCUMENT_ROOT"]);
$currentdir = getcwd();
$root_2 = str_replace($root_1, '', $currentdir);
$root_3 = explode("/", $root_2);
if ($root_3[1] == 'core') {
  echo $root_3[1];
  $root = realpath($_SERVER["DOCUMENT_ROOT"]);
}else{
  $root = $root_1 . '/' . $root_3[1];
}
use fkooman\OAuth\Client\Api;
use fkooman\OAuth\Client\Context;
use fkooman\OAuth\Client\GoogleClientConfig;
use fkooman\OAuth\Client\SessionStorage;
use fkooman\OAuth\Client\PdoStorage;
use Guzzle\Http\Client;
use fkooman\Guzzle\Plugin\BearerAuth\BearerAuth;
use fkooman\Guzzle\Plugin\BearerAuth\Exception\BearerErrorResponseException;
include($root.'/core/libs/OAuth2/vendor/autoload.php');

$clientConfig = new GoogleClientConfig(json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true));
$tokenStorage = new SessionStorage();
$api = new Api("foo", $clientConfig, $tokenStorage, new Client());

$context = new Context("mtrnord1@gmail.com", array("https://www.googleapis.com/auth/plus.login"));
$accessToken = $api->getAccessToken($context);

if(!isset($_COOKIE['PHPSESSID']) || !$_COOKIE['PHPSESSID'] == $accessToken) {
	echo "<a onClick=\"self.location='../../core/backend/admin/modules/modul_g-plus-login/login.php'\" class=\"btn btn-block btn-social btn-google-plus\"><i class=\"fa fa-google-plus\"></i>Login with Google+</a>";
}else{
	echo "<b style=\"color: white; text-align:center;\" class=\"btn btn-block btn-social btn-google-plus\"><i class=\"fa fa-google-plus\"></i>Logged in!</b>";
}
error_reporting($old_error_reporting);
?>
