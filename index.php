<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();


$clientId = "399216813040-2p64opsdbnqfsdoki3pbpihdsggb24b5np0.apps.googleusercontent.com";
$clientSecret = "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omU";
$redirectUri = "http://localhost/google-drive-api/login.php";

$client = new Google\Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->addScope(Google\Service\Drive::DRIVE_METADATA_READONLY);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive = new Google\Service\Drive($client);
  $files = $drive->files->listFiles(array())->getFiles();;
  
    echo "<pre>";
    print_r($files);


} else {
  $redirect_uri = 'http://localhost/google-drive-api/login.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}