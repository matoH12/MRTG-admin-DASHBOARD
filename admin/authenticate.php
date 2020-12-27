<?php
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');

	//echo password_verify('admin', '$2y$10$RnDwpen5c8.gtZLaxHEHDOKWY77t/20A4RRkWBsjlPuu7Wmy0HyBu'); exit;

	//Get DB instance.
	$db = getDbInstance();

	$db->where("user_name", $username);

	$row = $db->get('admin_accounts');

	if ($db->count >= 1) {

		$db_password = $row[0]['password'];
		$user_id = $row[0]['id'];

		if (password_verify($passwd, $db_password)) {

			$_SESSION['user_logged_in'] = TRUE;
            $_SESSION['user'] = $username;
			$_SESSION['admin_type'] = $row[0]['admin_type'];

            $db = getDbInstance();
            $udalost = 'Prihlasenie pouzivatela:  ' . $_SESSION['user'] . ' Prava: ' . $_SESSION['admin_type']  ;

            $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
            $db->insert('logs',$logs);

			if ($remember) {

				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token,PASSWORD_DEFAULT);
				

				$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));

				$expires = strtotime($expiry_time);
				
				setcookie('series_id', $series_id, $expires, "/");
				setcookie('remember_token', $remember_token, $expires, "/");

				$db = getDbInstance();
				$db->where ('id',$user_id);

				$update_remember = array(
					'series_id'=> $series_id,
					'remember_token' => $encryted_remember_token,
					'expires' =>$expiry_time
				);
				$db->update("admin_accounts", $update_remember);
			}
			//Authentication successfull redirect user
			header('Location:index.php');

		} else {
		
			$_SESSION['login_failure'] = "Invalid user name or password";
			header('Location:login.php');
		}

		exit;
	} else {
		$_SESSION['login_failure'] = "Invalid user name or password";
		header('Location:login.php');
		exit;
	}

}


else {

//if (!isset($_GET['client_id'])) {
//header('Location:login.php');
//}



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

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state, make sure HTTP sessions are enabled.');

} else {

    // Try to get an access token (using the authorization coe grant)
    try {
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
    } catch (Exception $e) {
        exit('Failed to get access token: '.$e->getMessage());
    }

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
//        printf('Hello %s!', $user->getName());

    } catch (Exception $e) {
        exit('Failed to get resource owner: '.$e->getMessage());
    }

    // Use this to interact with an API on the users behalf
//    echo $token->getToken();




        //Get DB instance.
        $db = getDbInstance();
	$users = remove_accents(preg_replace('/\s+/', '.', $user->getName()));
//	printf(gettype($users));
        $db->where('user_name',$users);
        $row = $db->get('admin_accounts');
//        print_r($row);


        if ($db->count >= 1) {



		if($row[0]['admin_type'] == 'admin' or $row[0]['admin_type'] == 'super') {
			$_SESSION['user_logged_in'] = TRUE;
            $_SESSION['user'] = remove_accents(preg_replace('/\s+/', '.', $user->getName()));
			$_SESSION['admin_type'] = $row[0]['admin_type'];

            $db = getDbInstance();
            $udalost = 'Prihlasenie pouzivatela:  ' . $_SESSION['user'] . ' Prava: ' . $_SESSION['admin_type']  ;

            $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
            $db->insert('logs',$logs);



            //Authentication successfull redirect user
	                header('Location:index.php');
		} else {
                        $_SESSION['login_failure'] = $users ." nemate prava na vstup";
                        header('Location:login.php');

		

		}

	} else {
	$db = getDbInstance();
	$users = array( "user_name" => remove_accents(preg_replace('/\s+/', '.', $user->getName())),
			"password" => generateRandomString(),
			"admin_type" => "users" );


//	print_r($users);
	$last_id = $db->insert('admin_accounts', $users);

            $db = getDbInstance();
            $udalost = 'Prihlasenie pouzivatela:  ' . $_SESSION['user'] . ' Prava: ' . $_SESSION['admin_type']  ;

            $logs = array('user' => $_SESSION['user'] , 'udalost' => $udalost);
            $db->insert('logs',$logs);


	$_SESSION['login_failure'] = $users["user_name"] . " nemate prava na vstup (novy pouzivatel)";
//	$_SESSION['login_failure'] = ;

	header('Location:login.php');






	}



}












//	die('Method Not allowed');



}
