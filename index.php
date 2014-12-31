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

include($root.'/core/libs/OpenID/openid.php');
$openid = new LightOpenID($_SERVER['SERVER_ADDR']);

$openid->identity = 'https://accounts.google.com/o/oauth2/auth';
$openid->required = array(
  'namePerson/first',
  'namePerson/last',
  'contact/email',
);
$openid->returnUrl = 'http://'.$_SERVER['SERVER_ADDR'].$rrot.'/core/backend/admin/modules/modul_g-plus-login/login.php'
?>

<a href="<?php echo $openid->authUrl() ?>">Login with Google</a>