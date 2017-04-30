<?php

/*!
 * ifsoft.co.uk v1.0
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * qascript@ifsoft.co.uk
 *
 * Copyright 2012-2016 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
 */

include_once($_SERVER['DOCUMENT_ROOT']."/core/init.inc.php");


if (auth::isSession()) {

    header("Location: /stream.php");
    exit;
}

if (isset($_SESSION['oauth']) && $_SESSION['oauth'] === 'facebook') {

    header("Location: /signup.php");
    exit;
}

require '../facebook.php';

if (isset($_GET['error'])) {

    header("Location: /signup.php");
    exit;
}

$facebook = new facebook(array(
    'appId' => FACEBOOK_APP_ID,
    'secret' => FACEBOOK_APP_SECRET,
));

$user = $facebook->getUser();

if ($user) {

    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');

    } catch (FacebookApiException $e) {

        header("Location: /facebook/signup.php");
        exit;
    }

    if (!empty($user_profile )) {

        # User info ok? Let's print it (Here we will be adding the login and registering routines)

        $uid = $user_profile['id'];

        $accountId = $helper->getUserIdByFacebook($uid);

        $account = new account($dbo, $accountId);
        $accountInfo = $account->get();

        if ($accountInfo['error'] === false) {

            //user with fb id exists in db

            if ($accountInfo['state'] == ACCOUNT_STATE_BLOCKED) {

                header("Location: /");
                exit;

            } else {

                $account->setState(ACCOUNT_STATE_ENABLED);
                $account->setLastActive();

                $clientId = 0; // Desktop version

                $auth = new auth($dbo);
                $access_data = $auth->create($accountId, $clientId);

                if ($access_data['error'] === false) {

                    auth::setSession($access_data['accountId'], $accountInfo['username'], $accountInfo['fullname'], $accountInfo['lowPhotoUrl'], $accountInfo['verify'], $account->getAccessLevel($access_data['accountId']), $access_data['accessToken']);
                    auth::updateCookie($accountInfo['username'], $access_data['accessToken']);

                    header("Location: /stream.php");
                }
            }

        } else {

            //new user
            $_SESSION['oauth'] = 'facebook';
            $_SESSION['oauth_id'] = $user_profile['id'];
            $_SESSION['oauth_name'] = $user_profile['name'];

            if (isset($user_profile['link'])) {

                $_SESSION['oauth_link'] = $user_profile['link'];
            }

            $_SESSION['oauth_email'] = "";

            if (isset($user_profile['email'])) {

                $_SESSION['oauth_email'] = $user_profile['email'];
            }

            header("Location: /signup.php");
            exit;
        }

    } else {

        # For testing purposes, if there was an error, let's kill the script
        header("Location: /signup.php");
        exit;
    }

} else {

    # There's no active session, let's generate one
    $login_url = $facebook->getLoginUrl(array( 'scope' => 'email, user_friends'));
    header("Location: " . $login_url);
}