<?php

$provider = require __DIR__ . '/provider.php';

if (!empty($_SESSION['token'])) {
  $token = unserialize($_SESSION['token']);
}

if (empty($token)) {
  header('Location: /');
  exit;
}

try {

  // We got an access token, let's now get the user's details
  $resource_owner  = $provider->getResourceOwner($token);

  // Use these details to create a new profile
  printf('Hello %s!', $resource_owner->getFirstName());
  
  printf("<pre>%s</pre>", print_r($resource_owner->toArray(), true));
    
} catch (Exception $e) {

  // Failed to get user details
  exit('Something went wrong: ' . $e->getMessage());

}