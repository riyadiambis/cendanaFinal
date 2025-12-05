<?php
/**
 * File Login dan Logout Admin
 * Dibuat oleh: Mahasiswa Informatika Unmul
 * Untuk: Tugas Pemrograman Web
 */

// Hubungkan ke database
require_once 'config/database.php';

// Mulai session
startSecureSession();

# Cek apakah ada form yang dikirim atau parameter logout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['action'] ?? '';
    
    // Kalau aksinya login
    if ($aksi === 'login') {
        prosesLogin($conn);
    } 
    // Kalau aksinya logout
    elseif ($aksi === 'logout') {
        prosesLogout();
    }
}

// Cek jika ada parameter logout di URL (GET request)
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    prosesLogout();
}

/**
 * Fungsi untuk proses login admin
 */
function prosesLogin($conn) {
    // Ambil password dari form
    $password = $_POST['password'] ?? '';
    
    // Cek apakah password diisi
    if (empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Password tidak boleh kosong'
        ]);
        exit();
    }
    
    // Password admin (bisa diganti sesuai kebutuhan)
    $passwordBenar = 'admin123';
    
    // Cek apakah password cocok
    if ($password === $passwordBenar) {
        // Simpan data login ke session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = 'admin';
        $_SESSION['admin_id'] = 1;
        $_SESSION['login_time'] = time();
        
        // Kirim response sukses
        echo json_encode([
            'success' => true,
            'message' => 'Login berhasil!',
            'redirect' => 'admin.php'
        ]);
    } else {
        // Kirim response gagal
        echo json_encode([
            'success' => false,
            'message' => 'Password salah. Silakan coba lagi.'
        ]);
    }
    exit();
}

/**
 * Fungsi untuk proses logout admin
 */
function prosesLogout() {
    // Hapus semua session
    destroyAdminSession();
    
    // Kembali ke halaman utama dengan path yang benar
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['REQUEST_URI']);
    $baseUrl = $protocol . $host . $path . '/index.php';
    
    // Redirect ke halaman utama
    header('Location: ' . $baseUrl);
    exit();
}
?>
