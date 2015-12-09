<?php

$provider = require __DIR__ . '/provider.php';

if (isset($_SESSION['token'])) {
  // Already have a token, skip to the user page.
  header('Location: /user.php');
} else if (!empty($_GET['error'])) {
  // Got an error, probably user denied access
  exit('Got error: ' . $_GET['error']);
} else if (empty($_GET['code'])) {
  // If we don't have an authorization code then get one
  $authUrl = $provider->getAuthorizationUrl(array("type" => "web_server"));
  header('Location: ' . $authUrl);
  exit;
} else {
  // Try to get an access token (using the authorization code grant)
  $token = $provider->getAccessToken('authorization_code', [
      'type' => 'web_server',
      'code' => $_GET['code']
  ]);
  $_SESSION['token'] = serialize($token);
  // Optional: Now you have a token you can look up a users profile data
  header('Location: /user.php');
}
