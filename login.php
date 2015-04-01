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
use fkooman\OAuth\Client\Api;
use fkooman\OAuth\Client\Context;
use fkooman\OAuth\Client\GoogleClientConfig;
use fkooman\OAuth\Client\SessionStorage;
use fkooman\OAuth\Client\PdoStorage;
use Guzzle\Http\Client;
use fkooman\Guzzle\Plugin\BearerAuth\BearerAuth;
use fkooman\Guzzle\Plugin\BearerAuth\Exception\BearerErrorResponseException;
include($root.'/core/libs/OAuth2/vendor/autoload.php');
/*
// Google
$googleClientConfig = new GoogleClientConfig(
    json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true)
);
$tokenStorage = new SessionStorage();
$api = new Api("foo", $googleClientConfig, $tokenStorage, new Client());
echo "test4";
$context = new Context("mtrnord1@gmail.com", array("https://www.googleapis.com/auth/plus.login"));
echo "test5";
$apiUri = "https://www.googleapis.com/auth/plus.login";
$accessToken = $api->getAccessToken($context);
if (false === $accessToken) {
    echo "test6";
    /* no valid access token available, go to authorization server *
    header("HTTP/1.1 302 Found");
    header("Location: " . $api->getAuthorizeUri($context));
    exit;
}else{
    header("HTTP/1.1 302 Found");
    header("Location: http://rpi.nordgedanken.de/cms_new/index.php");
}

try {
    $client = new Client();
    $bearerAuth = new BearerAuth($accessToken->getAccessToken());
    $client->addSubscriber($bearerAuth);
    $response = $client->get($apiUri)->send();
    header("Content-Type: application/json");
    echo $response->getBody();
} catch (BearerErrorResponseException $e) {
    if ("invalid_token" === $e->getBearerReason()) {
        // the token we used was invalid, possibly revoked, we throw it away
        $api->deleteAccessToken($context);
        $api->deleteRefreshToken($context);
        /* no valid access token available, go to authorization server *
        header("HTTP/1.1 302 Found");
        header("Location: ".$api->getAuthorizeUri($context));
        exit;
    }
    throw $e;
} catch (Exception $e) {
    die(sprintf('ERROR: %s', $e->getMessage()));
}
*/

try {
    /* OAuth client configuration */
    $clientConfig = new GoogleClientConfig(json_decode(file_get_contents($root.'/core/backend/admin/modules/modul_g-plus-login/client_secrets.json'), true));
    //$db = new PDO(sprintf("sqlite:%s/data/client.sqlite", __DIR__));
    //$tokenStorage = new PdoStorage($db);
    $tokenStorage = new SessionStorage();
    $api = new Api("foo", $clientConfig, $tokenStorage, new Client());
    $context = new Context("mtrnord1@gmail.com", array("https://www.googleapis.com/auth/plus.login"));
    /* the protected endpoint uri */
    $apiUri = "https://www.googleapis.com/auth/plus.login";
    /* get the access token */
    $accessToken = $api->getAccessToken($context);
    if (false === $accessToken) {
        /* no valid access token available just yet, go to authorization server */
        header("HTTP/1.1 302 Found");
        header("Location: ".$api->getAuthorizeUri($context));
        exit;
    }else{
        header("HTTP/1.1 302 Found");
        header("Location: http://rpi.nordgedanken.de/cms_new/index.php");
    }
    /* we have an access token */
    try {
        $client = new Client();
        $bearerAuth = new BearerAuth($accessToken->getAccessToken());
        $client->addSubscriber($bearerAuth);
        $response = $client->get($apiUri)->send();
        header("Content-Type: application/json");
        echo $response->getBody();
    } catch (BearerErrorResponseException $e) {
        if ("invalid_token" === $e->getBearerReason()) {
            /* no valid access token available just yet, go to authorization server */
            $api->deleteAccessToken($context);
            // Google does not support refresh tokens...
            // $api->deleteRefreshToken($context);
            header("HTTP/1.1 302 Found");
            header("Location: ".$api->getAuthorizeUri($context));
            exit;
        }
        throw $e;
    }
} catch (Exception $e) {
    echo sprintf("ERROR: %s", $e->getMessage());
}

?>
