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

use fkooman\php-oauth-client
use fkooman\guzzle-bearer-auth-plugin
use fkooman\OAuth\Common\Scope;
use Guzzle\Http\Client;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;

// Google
$googleClientConfig = new GoogleClientConfig(
    json_decode(file_get_contents("client_secrets.json"), true)
);
$api = new Api("foo", $googleClientConfig, new SessionStorage(), new \Guzzle\Http\Client());

$context = new Context("mtrnord1@gmail.com", array("read"));

if (false === $accessToken) {
    /* no valid access token available, go to authorization server */
    header("HTTP/1.1 302 Found");
    header("Location: " . $api->getAuthorizeUri($context));
    exit;
}


try {
    $cb = new Callback("foo", $clientConfig, new SessionStorage(), new \Guzzle\Http\Client());
    $cb->handleCallback($_GET);

    header("HTTP/1.1 302 Found");
    //header("Location: http://www.example.org/index.php");
} catch (AuthorizeException $e) {
    // this exception is thrown by Callback when the OAuth server returns a 
    // specific error message for the client, e.g.: the user did not authorize 
    // the request
    echo sprintf("ERROR: %s, DESCRIPTION: %s", $e->getMessage(), $e->getDescription());
} catch (Exception $e) {
    // other error, these should never occur in the normal flow
    echo sprintf("ERROR: %s", $e->getMessage());
}

$tokenStorage = new SessionStorage();

?>

<a href="">Login with Google</a>