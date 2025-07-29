<?php
    header('Access-Control-Allow-Origin: *');
    
    // Auto detect environment berdasarkan hostname atau IP
    $isLocal = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', 'localhost:8080']) 
               || strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;
    
    if ($isLocal) {
        // Local Configuration
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "perpustakaan";
        $environment = "LOCAL";
        
    } else {
        // Online Configuration  
        $hostname = "mysql.railway.internal";
        $username = "root";
        $password = "nfmBzAFpIdtfKQJpGRgrKsoSaVSyuRAe";
        $database = "railway";
        $environment = "ONLINE";
    }
    
    $charset = "utf8";
    $dsn = "mysql:host=$hostname;port=3306;dbname=$database;charset=$charset"; 
    $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    
    try {
        $pdo = new PDO($dsn, $username, $password, $opt);
        // Debug info (bisa dihapus nanti)
        error_log("Connected to: $environment - Host: " . $_SERVER['HTTP_HOST']);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    
    $data = array();
?>