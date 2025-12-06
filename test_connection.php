<?php
// Quick MySQL connectivity tester for XAMPP on Windows
// Tries common ports (3306, 3307) with user root and blank password

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db   = 'cendana_travel';
$ports = [3306, 3307];

$results = [];
foreach ($ports as $port) {
    $start = microtime(true);
    $conn = @new mysqli($host, $user, $pass, '', $port);
    $elapsed = round((microtime(true) - $start) * 1000, 1);

    if ($conn && !$conn->connect_error) {
        // Check if DB exists
        $dbExists = $conn->select_db($db);
        $results[] = [
            'port' => $port,
            'status' => 'OK',
            'details' => $dbExists ? "Database '$db' ditemukan" : "Database '$db' belum ada",
            'time_ms' => $elapsed,
        ];
    } else {
        $err = $conn ? $conn->connect_error : 'koneksi gagal';
        $results[] = [
            'port' => $port,
            'status' => 'FAIL',
            'details' => $err,
            'time_ms' => $elapsed,
        ];
    }
    if ($conn instanceof mysqli) {
        $conn->close();
    }
}

header('Content-Type: text/plain; charset=utf-8');
echo "MySQL Connection Test (XAMPP)\n";
echo "Host: $host, User: $user, Pass: [blank], DB: $db\n";
foreach ($results as $r) {
    echo "Port {$r['port']}: {$r['status']} ({$r['time_ms']} ms) - {$r['details']}\n";
}

echo "\nJika semua FAIL: pastikan MySQL di XAMPP sudah di-Start.\n";
echo "Jika hanya DB belum ada: buat database '$db' lalu import database.sql.\n";
