<?php // login.php
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

include($root.'/core/libs/OpenID/openid.php');
$openid = new LightOpenID($_SERVER['SERVER_ADDR']);

if ($openid->mode) {
    if ($openid->mode == 'cancel') {
        echo "User has canceled authentication!";
    } elseif($openid->validate()) {
        $data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
        echo "Identity: $openid->identity <br>";
        echo "Email: $email <br>";
        echo "First name: $first";
    } else {
        echo "The user has not logged in";
    }
} else {
    echo "Go to index page to log in.";
}
?>