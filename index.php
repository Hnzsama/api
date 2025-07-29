<?php
// Set CORS headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Aktifkan timezone agar tidak error di production
date_default_timezone_set('Asia/Jakarta'); // ganti sesuai kebutuhan server

// Periksa method yang diizinkan
if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Output data
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

http_response_code(200);
echo json_encode($server_info);
