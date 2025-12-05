<?php
/**
 * File Koneksi Database
 * Dibuat oleh: Mahasiswa Informatika Unmul
 * Untuk: Tugas Pemrograman Web - Cv. Cendana Travel
 */

// Konfigurasi Database (diset ke default XAMPP: user root tanpa password, port 3306)
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_PORT', 3306);
define('DB_NAME', 'cendana_travel');
define('DB_CHARSET', 'utf8mb4');

// Set timezone Indonesia (WIB)
date_default_timezone_set('Asia/Jakarta');

// Matikan error reporting untuk production
mysqli_report(MYSQLI_REPORT_OFF);
error_reporting(E_ALL);
ini_set('display_errors', 0);

/**
 * Fungsi untuk membuat koneksi database
 */
function createDatabaseConnection() {
    // Coba beberapa port umum (3306 default XAMPP, 3307 alternatif) agar tidak mentok di setting lama Linux
    $ports = array_unique([DB_PORT, 3307]);
    $errors = [];

    foreach ($ports as $port) {
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, $port);
        if ($conn && !$conn->connect_error) {
            $conn->set_charset(DB_CHARSET);
            return $conn;
        }
        $errors[] = "host=" . DB_HOST . " port=" . $port . " => " . ($conn ? $conn->connect_error : 'koneksi gagal');
    }

    // Berhenti dengan pesan gabungan supaya jelas port mana yang gagal
    die("Koneksi database gagal. Coba jalankan MySQL XAMPP dan pastikan database '" . DB_NAME . "' ada. Detail: " . implode(' | ', $errors));
}

// Buat koneksi database
$conn = createDatabaseConnection();

/**
 * ============================================
 * FUNGSI-FUNGSI BANTUAN UNTUK DATABASE
 * ============================================
 */

/**
 * Fungsi untuk escape string (mencegah SQL injection)
 */
function escapeString($conn, $string) {
    return $conn->real_escape_string($string);
}

/**
 * Fungsi untuk eksekusi query SELECT dan return hasil
 */
function fetchAll($conn, $sql) {
    $result = $conn->query($sql);
    if (!$result) {
        return [];
    }
    
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    return $data;
}

/**
 * Fungsi untuk eksekusi query SELECT dan return satu baris
 */
function fetchOne($conn, $sql) {
    $result = $conn->query($sql);
    if (!$result) {
        return null;
    }
    
    return $result->fetch_assoc();
}

/**
 * ============================================
 * FUNGSI-FUNGSI UNTUK SESSION
 * ============================================
 */

/**
 * Fungsi untuk start session dengan aman
 */
function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
        // Regenerate session ID untuk keamanan
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
        }
    }
}

/**
 * Fungsi untuk cek apakah admin sudah login
 */
function isAdminLoggedIn() {
    startSecureSession();
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Fungsi untuk set session admin saat login
 */
function setAdminSession($adminId, $username) {
    startSecureSession();
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = $adminId;
    $_SESSION['admin_username'] = $username;
    $_SESSION['login_time'] = time();
}

/**
 * Fungsi untuk hapus session admin saat logout
 */
function destroyAdminSession() {
    startSecureSession();
    $_SESSION = [];
    
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    session_destroy();
}

/**
 * ============================================
 * FUNGSI UNTUK LOGGING (OPSIONAL)
 * ============================================
 */

/**
 * Fungsi untuk log aktivitas
 */
function logActivity($message, $type = 'INFO') {
    $logFile = __DIR__ . '/../logs/activity.log';
    $logDir = dirname($logFile);
    
    // Buat folder logs kalau belum ada
    if (!file_exists($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] [$type] $message" . PHP_EOL;
    
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Return koneksi untuk digunakan di file lain
return $conn;
?>
