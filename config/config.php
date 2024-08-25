<?php
/**
 * @throws Exception
 */
function loadEnv($file): void
{
    if (!file_exists($file)) {
        throw new Exception("The .env file does not exist.");
    }

    $lines = file($file);
    foreach ($lines as $line) {
        // Skip empty lines and comments
        if (empty($line) || $line[0] === '#') {
            continue;
        }

        list($name, $value) = explode('=', trim($line), 2);
        $name = trim($name);
        $value = trim($value);

        if (!empty($name) && !empty($value)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
        }
    }
}

try {
    loadEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
    echo $e->getMessage();
}
