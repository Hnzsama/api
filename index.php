<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Get current timestamp
$timestamp = date('Y-m-d H:i:s');
$timezone = date_default_timezone_get();

// Server information
$server_info = [
    'status' => 'online',
    'message' => 'API Server is running successfully',
    'timestamp' => $timestamp,
    'timezone' => $timezone,
    'server' => [
        'php_version' => phpversion(),
        'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Railway',
        'http_host' => $_SERVER['HTTP_HOST'] ?? 'api-production-a3e6.up.railway.app'
    ],
    'endpoints' => [
        'health_check' => '/',
        'database_config' => '/db_config.php',
        'actions' => '/action.php'
    ]
];

// Return JSON response
http_response_code(200);
echo json_encode($server_info, JSON_PRETTY_PRINT);
?>