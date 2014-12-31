<?php

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
use fkooman\Guzzle\Plugin\BearerAuth\Exception\BearerErrorResponseException;
use fkooman\OAuth\Client\Callback;
use fkooman\OAuth\Client\SessionStorage;

// Google
$googleClientConfig = new GoogleClientConfig(
    json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true)
);

try {
    $cb = new Callback("foo", $googleClientConfig, new SessionStorage(), new \Guzzle\Http\Client());
    $cb->handleCallback($_GET);

    header("HTTP/1.1 302 Found");
    header("Location: http://".$_SERVER['HOST_NAME'].$root."/index.php");
} catch (AuthorizeException $e) {
    // this exception is thrown by Callback when the OAuth server returns a 
    // specific error message for the client, e.g.: the user did not authorize 
    // the request
    echo sprintf("ERROR: %s, DESCRIPTION: %s", $e->getMessage(), $e->getDescription());
} catch (Exception $e) {
    // other error, these should never occur in the normal flow
    echo sprintf("ERROR: %s", $e->getMessage());
}
?>