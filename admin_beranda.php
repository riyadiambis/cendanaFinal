<?php
/**
 * ============================================
 * ADMIN - CRUD KONTEN BERANDA
 * Mengelola semua konten di halaman beranda pelanggan
 * ============================================
 */

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: auth.php');
    exit;
}

require_once 'config/database.php';
require_once 'includes/functions.php';
require_once 'includes/home_sections_functions.php';

$companyInfo = getCompanyInfo();
$pageTitle = 'Kelola Konten Beranda';

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');
    
    $action = $_POST['action'] ?? '';
    $response = ['success' => false, 'message' => 'Invalid action'];
    
    switch ($action) {
        // HERO SECTION
        case 'update_hero':
            $id = $_POST['id'] ?? 0;
            $main_title = $_POST['main_title'] ?? '';
            $sub_title = $_POST['sub_title'] ?? '';
            $description = $_POST['description'] ?? '';
            
            $background_image = null;
            if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === 0) {
                $upload = uploadHomeImage($_FILES['background_image']);
                if ($upload['success']) {
                    $background_image = $upload['path'];
                }
            }
            
            if ($id > 0) {
                $success = updateHeroSection($id, $main_title, $sub_title, $description, $background_image);
            } else {
                $success = createHeroSection($main_title, $sub_title, $description, $background_image);
            }
            
            $response = ['success' => $success, 'message' => $success ? 'Hero section berhasil diupdate' : 'Gagal update hero section'];
            break;
            
        // WHY CHOOSE US
        case 'create_why_choose':
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $icon_class = $_POST['icon_class'] ?? 'fas fa-check-circle';
            $display_order = $_POST['display_order'] ?? 0;
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $upload = uploadHomeImage($_FILES['image']);
                if ($upload['success']) {
                    $image = $upload['path'];
                }
            }
            
            $success = createWhyChooseUs($title, $description, $image, $icon_class, $display_order);
            $response = ['success' => $success, 'message' => $success ? 'Item berhasil ditambahkan' : 'Gagal menambahkan item'];
            break;
            
        case 'update_why_choose':
            $id = $_POST['id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $icon_class = $_POST['icon_class'] ?? 'fas fa-check-circle';
            $display_order = $_POST['display_order'] ?? 0;
            $is_active = $_POST['is_active'] ?? 1;
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $upload = uploadHomeImage($_FILES['image']);
                if ($upload['success']) {
                    $image = $upload['path'];
                }
            }
            
            $success = updateWhyChooseUs($id, $title, $description, $image, $icon_class, $display_order, $is_active);
            $response = ['success' => $success, 'message' => $success ? 'Item berhasil diupdate' : 'Gagal update item'];
            break;
            
        case 'delete_why_choose':
            $id = $_POST['id'] ?? 0;
            $success = deleteWhyChooseUs($id);
            $response = ['success' => $success, 'message' => $success ? 'Item berhasil dihapus' : 'Gagal menghapus item'];
            break;
            
        // BOOKING STEPS
        case 'create_booking_step':
            $step_number = $_POST['step_number'] ?? 1;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $icon_class = $_POST['icon_class'] ?? 'fas fa-1';
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $upload = uploadHomeImage($_FILES['image']);
                if ($upload['success']) {
                    $image = $upload['path'];
                }
            }
            
            $success = createBookingStep($step_number, $title, $description, $image, $icon_class);
            $response = ['success' => $success, 'message' => $success ? 'Langkah berhasil ditambahkan' : 'Gagal menambahkan langkah'];
            break;
            
        case 'update_booking_step':
            $id = $_POST['id'] ?? 0;
            $step_number = $_POST['step_number'] ?? 1;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $icon_class = $_POST['icon_class'] ?? 'fas fa-1';
            $is_active = $_POST['is_active'] ?? 1;
            
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $upload = uploadHomeImage($_FILES['image']);
                if ($upload['success']) {
                    $image = $upload['path'];
                }
            }
            
            $success = updateBookingStep($id, $step_number, $title, $description, $image, $icon_class, $is_active);
            $response = ['success' => $success, 'message' => $success ? 'Langkah berhasil diupdate' : 'Gagal update langkah'];
            break;
            
        case 'delete_booking_step':
            $id = $_POST['id'] ?? 0;
            $success = deleteBookingStep($id);
            $response = ['success' => $success, 'message' => $success ? 'Langkah berhasil dihapus' : 'Gagal menghapus langkah'];
            break;
            
        // GALLERY SECTION
        case 'update_gallery_section':
            $id = $_POST['id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $button_text = $_POST['button_text'] ?? '';
            $button_link = $_POST['button_link'] ?? '';
            
            if ($id > 0) {
                $success = updateGallerySection($id, $title, $description, $button_text, $button_link);
            } else {
                $success = createGallerySection($title, $description, $button_text, $button_link);
            }
            
            $response = ['success' => $success, 'message' => $success ? 'Gallery section berhasil diupdate' : 'Gagal update gallery section'];
            break;
            
        case 'add_gallery_to_home':
            $gallery_id = $_POST['gallery_id'] ?? 0;
            $display_order = $_POST['display_order'] ?? 0;
            $success = addGalleryToHome($gallery_id, $display_order);
            $response = ['success' => $success, 'message' => $success ? 'Foto berhasil ditambahkan' : 'Gagal menambahkan foto (Max 3 atau sudah ada)'];
            break;
            
        case 'remove_gallery_from_home':
            $id = $_POST['id'] ?? 0;
            $success = removeGalleryFromHome($id);
            $response = ['success' => $success, 'message' => $success ? 'Foto berhasil dihapus dari beranda' : 'Gagal menghapus foto'];
            break;
    }
    
    echo json_encode($response);
    exit;
}

// Get data
$heroSection = getHeroSection();
$whyChooseUs = getAllWhyChooseUs();
$bookingSteps = getAllBookingSteps();
$gallerySection = getGallerySection();
$homeGallery = getHomeGallerySelection();
$allGallery = getAllGalleryImages();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - <?php echo htmlspecialchars($companyInfo['name']); ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="icons.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="admin-enhancements.css?v=<?php echo time(); ?>">
    
    <style>
        /* Admin Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f5f5f5;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #3e3228, #8c6b4a);
            color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .admin-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1600px;
            margin: 0 auto;
        }
        
        .admin-brand {
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .btn-logout {
            padding: 8px 20px;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-logout:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .admin-container {
            display: flex;
            min-height: calc(100vh - 70px);
        }
        
        .admin-sidebar {
            width: 260px;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            padding: 20px 0;
        }
        
        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .admin-nav-link:hover {
            background: #f9f6f2;
            color: #8c6b4a;
        }
        
        .admin-nav-link.active {
            background: linear-gradient(135deg, #8c6b4a, #a68563);
            color: white;
            border-left: 4px solid #3e3228;
        }
        
        .admin-main {
            flex: 1;
            background: #f5f5f5;
        }
        
        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #3e3228;
            margin-bottom: 10px;
        }
        
        .page-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
        }
        
        /* Admin Content Beranda Styling */
        .beranda-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }
        
        .section-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .section-title {
            font-size: 22px;
            font-weight: 700;
            color: #3e3228;
            margin: 0;
        }
        
        .btn-add {
            padding: 10px 20px;
            background: linear-gradient(135deg, #8c6b4a, #a68563);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(140, 107, 74, 0.3);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .item-card {
            background: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            position: relative;
        }
        
        .item-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .item-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #3e3228;
        }
        
        .item-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .item-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-edit,
        .btn-delete {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
        }
        
        .btn-edit {
            background: #4CAF50;
            color: white;
        }
        
        .btn-delete {
            background: #f44336;
            color: white;
        }
        
        .btn-edit:hover {
            background: #45a049;
        }
        
        .btn-delete:hover {
            background: #da190b;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            overflow-y: auto;
        }
        
        .modal-content {
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            max-width: 700px;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #999;
            cursor: pointer;
        }
        
        .modal-close:hover {
            color: #333;
        }
        
        .gallery-selector {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        
        .gallery-item {
            position: relative;
            cursor: pointer;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .gallery-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .gallery-item.selected {
            border: 3px solid #4CAF50;
        }
        
        .selected-count {
            background: #8c6b4a;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .btn-save {
            padding: 12px 30px;
            background: linear-gradient(135deg, #8c6b4a, #a68563);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(140, 107, 74, 0.3);
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .step-badge {
            display: inline-block;
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            background: #8c6b4a;
            color: white;
            border-radius: 50%;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="admin-header-container">
            <div class="admin-brand">
                <i class="icon icon-travel"></i>
                <span>Cendana Travel Admin</span>
            </div>
            <div class="admin-user">
                <span>Selamat datang, Admin</span>
                <a href="auth.php?action=logout" class="btn-logout"><i class="icon icon-logout"></i> Logout</a>
            </div>
        </div>
    </header>
    
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <nav class="admin-nav">
                <a href="admin.php" class="admin-nav-link">
                    <i class="icon icon-dashboard"></i> Dashboard
                </a>
                <a href="admin.php#kelola-transportasi" class="admin-nav-link">
                    <i class="icon icon-bus"></i> Kelola Transportasi
                </a>
                <a href="admin.php#galeri" class="admin-nav-link">
                    <i class="icon icon-image"></i> Galeri
                </a>
                <a href="admin_beranda.php" class="admin-nav-link active">
                    <i class="icon icon-home"></i> Konten Beranda
                </a>
                <a href="admin.php#kontak" class="admin-nav-link">
                    <i class="icon icon-phone"></i> Kontak
                </a>
                <a href="admin.php#pengaturan" class="admin-nav-link">
                    <i class="icon icon-settings"></i> Pengaturan
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="admin-main">
            <div class="beranda-content">
                <h1 class="page-title">Kelola Konten Beranda</h1>
                <p class="page-subtitle">Atur dan kelola seluruh konten yang muncul di halaman beranda pelanggan</p>
                
                <div id="alertContainer"></div>
                
                <!-- 1. HERO SECTION -->
                <div class="section-card">
                    <div class="section-header">
                        <h2 class="section-title">1. Hero Section (Jelajahi Dunia)</h2>
                    </div>
                    
                    <form id="heroForm" enctype="multipart/form-data">
                        <input type="hidden" name="ajax" value="1">
                        <input type="hidden" name="action" value="update_hero">
                        <input type="hidden" name="id" value="<?php echo $heroSection['id']; ?>">
                        
                        <div class="form-group">
                            <label>Judul Utama</label>
                            <input type="text" name="main_title" value="<?php echo htmlspecialchars($heroSection['main_title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Sub Judul</label>
                            <input type="text" name="sub_title" value="<?php echo htmlspecialchars($heroSection['sub_title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" required><?php echo htmlspecialchars($heroSection['description']); ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Background Image (Optional)</label>
                            <?php if ($heroSection['background_image']): ?>
                                <img src="<?php echo htmlspecialchars($heroSection['background_image']); ?>" style="max-width: 200px; margin-bottom: 10px; border-radius: 8px;">
                            <?php endif; ?>
                            <input type="file" name="background_image" accept="image/*">
                        </div>
                        
                        <button type="submit" class="btn-save">Simpan Hero Section</button>
                    </form>
                </div>
                
                <!-- 2. MENGAPA MEMILIH KAMI -->
                <div class="section-card">
                    <div class="section-header">
                        <h2 class="section-title">2. Mengapa Memilih Kami</h2>
                        <button class="btn-add" onclick="openWhyChooseModal()">+ Tambah Item</button>
                    </div>
                    
                    <div class="items-grid">
                        <?php foreach ($whyChooseUs as $item): ?>
                        <div class="item-card">
                            <?php if ($item['image']): ?>
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <?php endif; ?>
                            <h3><i class="<?php echo htmlspecialchars($item['icon_class']); ?>"></i> <?php echo htmlspecialchars($item['title']); ?></h3>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <div class="item-actions">
                                <button class="btn-edit" onclick='editWhyChoose(<?php echo json_encode($item); ?>)'>Edit</button>
                                <button class="btn-delete" onclick="deleteWhyChoose(<?php echo $item['id']; ?>)">Hapus</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- 3. BAGAIMANA CARA MEMESAN -->
                <div class="section-card">
                    <div class="section-header">
                        <h2 class="section-title">3. Bagaimana Cara Memesan</h2>
                        <button class="btn-add" onclick="openBookingStepModal()">+ Tambah Langkah</button>
                    </div>
                    
                    <div class="items-grid">
                        <?php foreach ($bookingSteps as $step): ?>
                        <div class="item-card">
                            <?php if ($step['image']): ?>
                                <img src="<?php echo htmlspecialchars($step['image']); ?>" alt="Step <?php echo $step['step_number']; ?>">
                            <?php endif; ?>
                            <h3>
                                <span class="step-badge"><?php echo $step['step_number']; ?></span>
                                <?php echo htmlspecialchars($step['title']); ?>
                            </h3>
                            <p><?php echo htmlspecialchars($step['description']); ?></p>
                            <div class="item-actions">
                                <button class="btn-edit" onclick='editBookingStep(<?php echo json_encode($step); ?>)'>Edit</button>
                                <button class="btn-delete" onclick="deleteBookingStep(<?php echo $step['id']; ?>)">Hapus</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- 4. GALERI PERJALANAN -->
                <div class="section-card">
                    <div class="section-header">
                        <h2 class="section-title">4. Galeri Perjalanan</h2>
                        <span class="selected-count">Terpilih: <?php echo count($homeGallery); ?>/3</span>
                    </div>
                    
                    <form id="gallerySectionForm">
                        <input type="hidden" name="ajax" value="1">
                        <input type="hidden" name="action" value="update_gallery_section">
                        <input type="hidden" name="id" value="<?php echo $gallerySection['id']; ?>">
                        
                        <div class="form-group">
                            <label>Judul Section</label>
                            <input type="text" name="title" value="<?php echo htmlspecialchars($gallerySection['title']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" required><?php echo htmlspecialchars($gallerySection['description']); ?></textarea>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="form-group">
                                <label>Teks Tombol</label>
                                <input type="text" name="button_text" value="<?php echo htmlspecialchars($gallerySection['button_text']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Link Tombol</label>
                                <input type="text" name="button_link" value="<?php echo htmlspecialchars($gallerySection['button_link']); ?>" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-save">Simpan Konten Galeri</button>
                    </form>
                    
                    <hr style="margin: 30px 0;">
                    
                    <h3 style="margin-bottom: 20px;">Foto Terpilih (Maksimal 3)</h3>
                    <div class="items-grid">
                        <?php foreach ($homeGallery as $gal): ?>
                        <div class="item-card">
                            <img src="<?php echo htmlspecialchars($gal['image']); ?>" alt="<?php echo htmlspecialchars($gal['title']); ?>">
                            <h3><?php echo htmlspecialchars($gal['title']); ?></h3>
                            <div class="item-actions">
                                <button class="btn-delete" onclick="removeGalleryFromHome(<?php echo $gal['id']; ?>)">Hapus dari Beranda</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <button class="btn-add" onclick="openGallerySelector()" style="margin-top: 20px; width: 100%;">+ Pilih Foto dari Galeri</button>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Modals -->
    <!-- Why Choose Us Modal -->
    <div id="whyChooseModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('whyChooseModal')">&times;</span>
            <h2 id="whyChooseModalTitle">Tambah Item Mengapa Memilih Kami</h2>
            
            <form id="whyChooseForm" enctype="multipart/form-data">
                <input type="hidden" name="ajax" value="1">
                <input type="hidden" name="action" id="whyChooseAction" value="create_why_choose">
                <input type="hidden" name="id" id="whyChooseId" value="0">
                
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" id="whyChooseTitle" required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" id="whyChooseDescription" required></textarea>
                </div>
                
                <div class="form-group">
                    <label>Icon Class (Font Awesome)</label>
                    <input type="text" name="icon_class" id="whyChooseIcon" value="fas fa-check-circle" required>
                    <small>Contoh: fas fa-check-circle, fas fa-shield-alt, fas fa-certificate</small>
                </div>
                
                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="display_order" id="whyChooseOrder" value="0" required>
                </div>
                
                <div class="form-group">
                    <label>Foto (Optional)</label>
                    <input type="file" name="image" id="whyChooseImage" accept="image/*">
                    <img id="whyChooseImagePreview" style="max-width: 200px; margin-top: 10px; display: none; border-radius: 8px;">
                </div>
                
                <div class="form-group" id="whyChooseStatusGroup" style="display: none;">
                    <label>Status</label>
                    <select name="is_active" id="whyChooseStatus">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-save">Simpan</button>
            </form>
        </div>
    </div>
    
    <!-- Booking Step Modal -->
    <div id="bookingStepModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal('bookingStepModal')">&times;</span>
            <h2 id="bookingStepModalTitle">Tambah Langkah Pemesanan</h2>
            
            <form id="bookingStepForm" enctype="multipart/form-data">
                <input type="hidden" name="ajax" value="1">
                <input type="hidden" name="action" id="bookingStepAction" value="create_booking_step">
                <input type="hidden" name="id" id="bookingStepId" value="0">
                
                <div class="form-group">
                    <label>Nomor Langkah</label>
                    <input type="number" name="step_number" id="bookingStepNumber" min="1" required>
                </div>
                
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" id="bookingStepTitle" required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" id="bookingStepDescription" required></textarea>
                </div>
                
                <div class="form-group">
                    <label>Icon Class (Font Awesome)</label>
                    <input type="text" name="icon_class" id="bookingStepIcon" value="fas fa-1" required>
                    <small>Contoh: fas fa-search, fas fa-comments, fas fa-credit-card</small>
                </div>
                
                <div class="form-group">
                    <label>Foto (Optional)</label>
                    <input type="file" name="image" id="bookingStepImage" accept="image/*">
                    <img id="bookingStepImagePreview" style="max-width: 200px; margin-top: 10px; display: none; border-radius: 8px;">
                </div>
                
                <div class="form-group" id="bookingStepStatusGroup" style="display: none;">
                    <label>Status</label>
                    <select name="is_active" id="bookingStepStatus">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-save">Simpan</button>
            </form>
        </div>
    </div>
    
    <!-- Gallery Selector Modal -->
    <div id="gallerySelectorModal" class="modal">
        <div class="modal-content" style="max-width: 900px;">
            <span class="modal-close" onclick="closeModal('gallerySelectorModal')">&times;</span>
            <h2>Pilih Foto dari Galeri (Maksimal 3)</h2>
            <p>Klik foto untuk menambahkan ke beranda. Maksimal 3 foto.</p>
            
            <div class="gallery-selector">
                <?php foreach ($allGallery as $gal): ?>
                <div class="gallery-item" data-id="<?php echo $gal['id']; ?>" onclick="selectGalleryImage(this, <?php echo $gal['id']; ?>)">
                    <img src="<?php echo htmlspecialchars($gal['image']); ?>" alt="<?php echo htmlspecialchars($gal['title']); ?>">
                    <div style="padding: 5px; font-size: 12px; background: rgba(0,0,0,0.7); color: white; text-align: center;">
                        <?php echo htmlspecialchars($gal['title']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <button class="btn-save" onclick="saveGallerySelection()">Tambahkan ke Beranda</button>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin_beranda.js?v=<?php echo time(); ?>"></script>
</body>
</html>
