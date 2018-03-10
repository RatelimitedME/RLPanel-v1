<!DOCTYPE html>
<html>
<head>
    <meta content="The RATELIMITED User Dashboard allows for editing the meta tags of your images, managing your account on RATELIMITED and more!" property="og:description">
    <meta content="RATELIMITED &middot; Dashboard" property="og:title">
    <meta content="RATELIMITED Dashboard" property="og:site_name">
    <link rel="icon" href="https://cdn.discordapp.com/emojis/316898198109290496.png" />
    <meta content='https://cdn.discordapp.com/emojis/316898198109290496.png' property='og:image'>
    <meta content='image/png' property='og:image:type'>
    <meta content='1821' property='og:image:width'>
    <meta content='2082' property='og:image:height'>
    <meta name="theme-color" content="#2c3e50">
</head>
</html>
<?php

require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../../rlmeappcreds.inc.php';

$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId' => '384351888575037440',
    'clientSecret' => $clientSecret,
    'redirectUri' => 'https://panel.ratelimited.me'
]);

if(!isset($_GET['code'])){

    // Step 1. Get authorization code
    $options = [
    'state' => 'RLPanel_LOGIN',
    'scope' => ['identify', 'email'] // array or string
    ];
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Step 2. Get an access token using the provided authorization code
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);


    // Step 3. (Optional) Look up the user's profile with the provided token
    try {

        $user = $provider->getResourceOwner($token);

        $_SESSION['discordId'] = $user->toArray()['id'];
        $_SESSION['loggedInAs'] = $user->getUsername() . "#" . $user->getDiscriminator();
        $_SESSION['discordUserName'] = $user->getUsername();
        $_SESSION['discordAvatar'] = "https://cdn.discordapp.com/avatars/" . $user->toArray()['id'] . "/" . $user->toArray()['avatar'] . ".png?size=128"; // No support for GIF profiles because I'm a lazy fuck
        include __DIR__ . '/../libs/authLib.inc.php';

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');

    }
}
