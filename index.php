<?php
// Waktu server sekarang
date_default_timezone_set("Asia/Jakarta"); // Ganti sesuai lokasi
$now = date("Y-m-d H:i:s");

// Cek apakah server hidup
if ($_SERVER['SERVER_ADDR']) {
    echo "<h1>✅ Server Hidup</h1>";
} else {
    echo "<h1>❌ Server Mati</h1>";
}

// Tampilkan IP dan waktu
echo "<p>Server IP: " . $_SERVER['SERVER_ADDR'] . "</p>";
echo "<p>Waktu Sekarang: $now</p>";
?>
