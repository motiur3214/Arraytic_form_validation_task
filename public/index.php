<?php

require_once '../config/database.php';
require_once '../routes/web.php';

// Get the full request URI
$request_uri = trim($_SERVER['REQUEST_URI'], '/');

// Remove the script name (base directory) from the request URI
$script_name = trim(dirname($_SERVER['SCRIPT_NAME']), '/');

// If the base directory is in the URI, remove it
if ($script_name && str_starts_with($request_uri, $script_name)) {
    $uri = substr($request_uri, strlen($script_name) + 1);
} else {
    $uri = $request_uri;
}

// Normalize the URI to ensure it matches the route definitions
$uri = trim($uri, '/');

if ($uri === 'home') {
    $uri = '';
}

route($uri);