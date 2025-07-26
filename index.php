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

// VARIANT 1 - Library Management System
$server_info = [
    'status' => 'active',
    'service' => 'Library Management API',
    'message' => 'Service operational and ready',
    'timestamp' => date('Y-m-d H:i:s'),
    'timezone' => date_default_timezone_get(),
    'version' => '1.2.0',
    'build' => 'LMS-2024-001',
    'system' => [
        'php_version' => phpversion(),
    ],
    'features' => [
        'book_management' => 'enabled',
    ]
];