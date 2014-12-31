<?php
try {
    $cb = new Callback("foo", $clientConfig, new SessionStorage(), new \Guzzle\Http\Client());
    $cb->handleCallback($_GET);

    header("HTTP/1.1 302 Found");
    header("Location: http://".$_SERVER['NAME']."/index.php");
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