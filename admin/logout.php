<?php
require_once './config/config.php';
//session_start();
//session_destroy();

//if($_SESSION['oauth2state']){
	$provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
	'authServerUrl'         => 'https://sso.uvt.tuke.sk/auth',
	'realm'                 => 'TUKE',
	'clientId'              => 'mrtg.uvt.tuke.sk',
	'clientSecret'          => '39d50b9d-22a4-49af-9049-587547247391',
	'redirectUri'           => 'https://mrtg.uvt.tuke.sk/admin/authenticate.php',
	//    'encryptionAlgorithm'   => 'RS256',                             // optional
	//    'encryptionKeyPath'     => '../key.pem'                         // optional
	//    'encryptionKey'         => 'contents_of_key_or_certificate'     // optional
	]);
	$authUrl = $provider->getLogoutUrl();
//	echo $authUrl;
	session_start();
	session_destroy();
	clearAuthCookie();
	header('Location: ' . $authUrl);
//}


//session_start();
//session_destroy();

//if(isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token'])){
//
//        clearAuthCookie();
//
//}
//header('Location:index.php');
//exit;

 ?>
