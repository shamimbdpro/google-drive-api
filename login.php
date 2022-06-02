<?php 

require_once __DIR__.'/vendor/autoload.php';

session_start();


$clientId = "399216813040-2p64opsdfsdbnqoki3pbpihdsggb24b5np0.apps.googleusercontent.com";
$clientSecret = "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omU";
$redirectUri = "http://localhost/google-drive-api/login.php";

$client = new Google\Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);

$client->setIncludeGrantedScopes(true);
$client->setRedirectUri($redirectUri);
$client->addScope(Google\Service\Drive::DRIVE_METADATA_READONLY);

if (! isset($_GET['code'])) {

  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

} else {

  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri = 'http://localhost/google-drive-api/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}



 ?>