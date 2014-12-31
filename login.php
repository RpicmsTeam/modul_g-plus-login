<?php // index.php

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

include($root.'/core/libs/OAuth2/vendor/autoload.php');

use fkooman\OAuth\Client\GoogleClientConfig;
use fkooman\OAuth\Client\Api;
use fkooman\OAuth\Client\Context;
use fkooman\Guzzle\Plugin\BearerAuth\BearerAuth;


// Google
$googleClientConfig = new GoogleClientConfig(
    json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true)
);
$api = new Api("foo", $googleClientConfig, new SessionStorage(), new \Guzzle\Http\Client());

$context = new Context("mtrnord1@gmail.com", array("https://www.googleapis.com/auth/plus.login"));

$accessToken = $api->getAccessToken($context);
if (false === $accessToken) {
    /* no valid access token available, go to authorization server */
    header("HTTP/1.1 302 Found");
    header("Location: " . $api->getAuthorizeUri($context));
    exit;
}




?>