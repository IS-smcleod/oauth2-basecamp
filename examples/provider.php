<?php

require __DIR__ . '/../vendor/autoload.php';

use League\OAuth2\Client\Provider\Basecamp;

// Replace these with your token settings
$clientId     = '';
$clientSecret = '';

// Change this if you are not using the built-in PHP server
$redirectUri  = 'http://localhost:8080/';

// Start the session
session_start();

// Initialize the provider
$provider = new Basecamp(compact('clientId', 'clientSecret', 'redirectUri'));

// No HTML for demo, prevents any attempt at XSS
header('Content-Type', 'text/plain');

return $provider;
