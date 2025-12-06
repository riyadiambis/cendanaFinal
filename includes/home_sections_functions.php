<?php
/**
 * ============================================
 * HOME SECTIONS CRUD FUNCTIONS V2
 * Functions untuk mengelola konten Beranda Pelanggan
 * ============================================
 */

// ============================================
// 1. HERO SECTION
// ============================================

function getHeroSection() {
    global $conn;
    $sql = "SELECT * FROM home_hero_section WHERE is_active = 1 LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    // Return default jika belum ada
    return [
        'id' => 0,
        'main_title' => 'Jelajahi Dunia',
        'sub_title' => 'Kapan Saja & Dimana Saja',
        'description' => 'Pilih moda transportasi favorit Anda dengan pelayanan premium.',
        'background_image' => null
    ];
}

function updateHeroSection($id, $main_title, $sub_title, $description, $background_image = null) {
    global $conn;
    
    if ($background_image) {
        $stmt = $conn->prepare("UPDATE home_hero_section SET main_title=?, sub_title=?, description=?, background_image=? WHERE id=?");
        $stmt->bind_param("ssssi", $main_title, $sub_title, $description, $background_image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE home_hero_section SET main_title=?, sub_title=?, description=? WHERE id=?");
        $stmt->bind_param("sssi", $main_title, $sub_title, $description, $id);
    }
    
    return $stmt->execute();
}

function createHeroSection($main_title, $sub_title, $description, $background_image = null) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO home_hero_section (main_title, sub_title, description, background_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $main_title, $sub_title, $description, $background_image);
    return $stmt->execute();
}


// ============================================
// 2. MENGAPA MEMILIH KAMI (Why Choose Us)
// ============================================

function getAllWhyChooseUs() {
    global $conn;
    $sql = "SELECT * FROM home_why_choose_us WHERE is_active = 1 ORDER BY display_order ASC, id ASC";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getWhyChooseUsById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM home_why_choose_us WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_assoc() : null;
}

function createWhyChooseUs($title, $description, $image, $icon_class, $display_order) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO home_why_choose_us (title, description, image, icon_class, display_order) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $description, $image, $icon_class, $display_order);
    return $stmt->execute();
}

function updateWhyChooseUs($id, $title, $description, $image, $icon_class, $display_order, $is_active) {
    global $conn;
    
    if ($image !== null) {
        $stmt = $conn->prepare("UPDATE home_why_choose_us SET title=?, description=?, image=?, icon_class=?, display_order=?, is_active=? WHERE id=?");
        $stmt->bind_param("ssssiii", $title, $description, $image, $icon_class, $display_order, $is_active, $id);
    } else {
        $stmt = $conn->prepare("UPDATE home_why_choose_us SET title=?, description=?, icon_class=?, display_order=?, is_active=? WHERE id=?");
        $stmt->bind_param("sssii", $title, $description, $icon_class, $display_order, $is_active, $id);
    }
    
    return $stmt->execute();
}

function deleteWhyChooseUs($id) {
    global $conn;
    
    // Get image path before delete
    $item = getWhyChooseUsById($id);
    if ($item && $item['image']) {
        $imagePath = __DIR__ . '/../' . $item['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $stmt = $conn->prepare("DELETE FROM home_why_choose_us WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


// ============================================
// 3. BAGAIMANA CARA MEMESAN (Booking Steps)
// ============================================

function getAllBookingSteps() {
    global $conn;
    $sql = "SELECT * FROM home_booking_steps WHERE is_active = 1 ORDER BY step_number ASC";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getBookingStepById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM home_booking_steps WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result ? $result->fetch_assoc() : null;
}

function createBookingStep($step_number, $title, $description, $image, $icon_class) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO home_booking_steps (step_number, title, description, image, icon_class) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $step_number, $title, $description, $image, $icon_class);
    return $stmt->execute();
}

function updateBookingStep($id, $step_number, $title, $description, $image, $icon_class, $is_active) {
    global $conn;
    
    if ($image !== null) {
        $stmt = $conn->prepare("UPDATE home_booking_steps SET step_number=?, title=?, description=?, image=?, icon_class=?, is_active=? WHERE id=?");
        $stmt->bind_param("issssii", $step_number, $title, $description, $image, $icon_class, $is_active, $id);
    } else {
        $stmt = $conn->prepare("UPDATE home_booking_steps SET step_number=?, title=?, description=?, icon_class=?, is_active=? WHERE id=?");
        $stmt->bind_param("isssii", $step_number, $title, $description, $icon_class, $is_active, $id);
    }
    
    return $stmt->execute();
}

function deleteBookingStep($id) {
    global $conn;
    
    // Get image path before delete
    $item = getBookingStepById($id);
    if ($item && $item['image']) {
        $imagePath = __DIR__ . '/../' . $item['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $stmt = $conn->prepare("DELETE FROM home_booking_steps WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


// ============================================
// 4. GALERI SECTION INFO
// ============================================

function getGallerySection() {
    global $conn;
    $sql = "SELECT * FROM home_gallery_section WHERE is_active = 1 LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    // Return default
    return [
        'id' => 0,
        'title' => 'Galeri Perjalanan',
        'description' => 'Temukan inspirasi destinasi wisata terbaik dari koleksi perjalanan kami yang tak terlupakan.',
        'button_text' => 'Lihat Selengkapnya',
        'button_link' => 'galeri.php'
    ];
}

function updateGallerySection($id, $title, $description, $button_text, $button_link) {
    global $conn;
    $stmt = $conn->prepare("UPDATE home_gallery_section SET title=?, description=?, button_text=?, button_link=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $button_text, $button_link, $id);
    return $stmt->execute();
}

function createGallerySection($title, $description, $button_text, $button_link) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO home_gallery_section (title, description, button_text, button_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $button_text, $button_link);
    return $stmt->execute();
}


// ============================================
// 5. GALERI SELECTION (Pilih 3 Foto dari Galeri)
// ============================================

function getHomeGallerySelection() {
    global $conn;
    $sql = "SELECT hgs.*, g.title, g.description, g.image, g.category 
            FROM home_gallery_selection hgs
            JOIN gallery g ON hgs.gallery_id = g.id
            WHERE hgs.is_active = 1 AND g.is_active = 1
            ORDER BY hgs.display_order ASC
            LIMIT 3";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getAllGalleryImages() {
    global $conn;
    $sql = "SELECT * FROM gallery WHERE is_active = 1 ORDER BY upload_date DESC";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function addGalleryToHome($gallery_id, $display_order) {
    global $conn;
    
    // Check if already exists
    $stmt = $conn->prepare("SELECT id FROM home_gallery_selection WHERE gallery_id = ?");
    $stmt->bind_param("i", $gallery_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return false; // Already exists
    }
    
    // Check limit (max 3)
    $count_sql = "SELECT COUNT(*) as total FROM home_gallery_selection WHERE is_active = 1";
    $count_result = $conn->query($count_sql);
    $count = $count_result->fetch_assoc()['total'];
    
    if ($count >= 3) {
        return false; // Max limit reached
    }
    
    $stmt = $conn->prepare("INSERT INTO home_gallery_selection (gallery_id, display_order) VALUES (?, ?)");
    $stmt->bind_param("ii", $gallery_id, $display_order);
    return $stmt->execute();
}

function removeGalleryFromHome($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM home_gallery_selection WHERE id=?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function updateGalleryHomeOrder($id, $display_order) {
    global $conn;
    $stmt = $conn->prepare("UPDATE home_gallery_selection SET display_order=? WHERE id=?");
    $stmt->bind_param("ii", $display_order, $id);
    return $stmt->execute();
}


// ============================================
// HELPER FUNCTIONS
// ============================================

function uploadHomeImage($file, $directory = 'uploads/home/') {
    // Create directory if not exists
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }
    
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $filename = $file['name'];
    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed)) {
        return ['success' => false, 'message' => 'Format file tidak diizinkan'];
    }
    
    // Generate unique filename
    $new_filename = 'home_' . time() . '_' . uniqid() . '.' . $file_ext;
    $target_path = $directory . $new_filename;
    
    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return ['success' => true, 'path' => $target_path];
    }
    
    return ['success' => false, 'message' => 'Gagal upload file'];
}

function deleteHomeImage($path) {
    if ($path && file_exists($path)) {
        return unlink($path);
    }
    return false;
}
?>
