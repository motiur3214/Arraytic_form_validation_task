<?php
require_once '../app/models/Submission.php';
function route($uri)
{
    // Remove any query string parameters from the URI and normalize the URI
    $path = parse_url($uri, PHP_URL_PATH);
    $path = trim($path, '/');

    // Define the available routes
    $routes = [
        '' => 'SubmissionController@index',
        'submit' => 'SubmissionController@submit',
        'report' => 'SubmissionController@report',
    ];

    // Check if the path exists in the routes array
    if (array_key_exists($path, $routes)) {
        // Call the associated controller method
        list($controller, $method) = explode('@', $routes[$path]);
        require_once "../app/controllers/$controller.php";
        global $db;
        $submissionModel = new Submission($db);
        $controllerInstance = new $controller($submissionModel);

        // Pass query parameters if they exist
        if ($method === 'report') {
            // Pass the $_GET array to the report method
            $controllerInstance->$method($_GET);
        } else {
            // Call the method without additional parameters
            $controllerInstance->$method();
        }
    } else {
        // Handle 404
        http_response_code(404);
        echo "404 - Page not found";
        echo "<br>";
        echo "check your url: ".$uri;
    }
}


