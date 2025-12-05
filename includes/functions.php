<?php
// fungsi-fungsi helper buat CRUD
// pakai mysqli aja biar gampang debug

require_once __DIR__ . '/../config/database.php';

// ambil data company info
function getCompanyInfo() {
    global $conn;
    $sql = "SELECT * FROM company_info WHERE id = 1";
    $result = fetchOne($conn, $sql);
    return $result ? $result : [];
}

// update company info
function updateCompanyInfo($data) {
    global $conn;
    
    $name = escapeString($conn, $data['name']);
    $whatsapp = escapeString($conn, $data['whatsapp']);
    $instagram = escapeString($conn, $data['instagram']);
    $email = escapeString($conn, $data['email']);
    $address = escapeString($conn, $data['address']);
    $hours = escapeString($conn, $data['hours']);
    $description = escapeString($conn, $data['description']);
    
    $sql = "UPDATE company_info SET 
            name = '$name',
            whatsapp = '$whatsapp',
            instagram = '$instagram',
            email = '$email',
            address = '$address',
            hours = '$hours',
            description = '$description',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = 1";
            
    return $conn->query($sql);
}

// fungsi buat banner homepage

// ambil semua banner
function getAllBanners() {
    global $conn;
    $sql = "SELECT * FROM homepage_banners ORDER BY display_order ASC, id ASC";
    return fetchAll($conn, $sql);
}

// ambil banner by ID
function getBannerById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM homepage_banners WHERE id = $id";
    return fetchOne($conn, $sql);
}

//
function addBanner($data, $imagePath = null) {
    global $conn;
    
    $title = escapeString($conn, $data['title']);
    $subtitle = escapeString($conn, $data['subtitle']);
    $image = $imagePath ? escapeString($conn, $imagePath) : '';
    $link_url = escapeString($conn, $data['link_url']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $sql = "INSERT INTO homepage_banners (title, subtitle, image, link_url, is_active, display_order) 
            VALUES ('$title', '$subtitle', '$image', '$link_url', $is_active, $display_order)";
            
    return $conn->query($sql);
}

// update banner
function updateBanner($id, $data, $imagePath = null) {
    global $conn;
    
    $id = intval($id);
    $title = escapeString($conn, $data['title']);
    $subtitle = escapeString($conn, $data['subtitle']);
    $link_url = escapeString($conn, $data['link_url']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $imageUpdate = "";
    if ($imagePath) {
        $image = escapeString($conn, $imagePath);
        $imageUpdate = ", image = '$image'";
    }
    
    $sql = "UPDATE homepage_banners SET 
            title = '$title',
            subtitle = '$subtitle',
            link_url = '$link_url',
            is_active = $is_active,
            display_order = $display_order,
            updated_at = CURRENT_TIMESTAMP
            $imageUpdate
            WHERE id = $id";
            
    return $conn->query($sql);
}

// hapus banner
function deleteBanner($id) {
    global $conn;
    $id = intval($id);
    
    // Ambil data banner untuk hapus file gambar
    $banner = getBannerById($id);
    if ($banner && $banner['image'] && file_exists($banner['image'])) {
        unlink($banner['image']);
    }
    
    $sql = "DELETE FROM homepage_banners WHERE id = $id";
    return $conn->query($sql);
}

// fungsi buat gallery

// ambil semua galeri
function getAllGallery() {
    global $conn;
    $sql = "SELECT * FROM gallery ORDER BY is_featured DESC, display_order ASC, id DESC";
    return fetchAll($conn, $sql);
}

// ambil galeri by ID
function getGalleryById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM gallery WHERE id = $id";
    return fetchOne($conn, $sql);
}

// tambah galeri baru
function addGallery($data, $imagePath) {
    global $conn;
    
    $title = escapeString($conn, $data['title']);
    $description = escapeString($conn, $data['description']);
    $image = escapeString($conn, $imagePath);
    $category = escapeString($conn, $data['category']);
    $is_featured = isset($data['is_featured']) ? 1 : 0;
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $sql = "INSERT INTO gallery (title, description, image, category, is_featured, is_active, display_order) 
            VALUES ('$title', '$description', '$image', '$category', $is_featured, $is_active, $display_order)";
            
    return $conn->query($sql);
}

// update galeri
function updateGallery($id, $data, $imagePath = null) {
    global $conn;
    
    $id = intval($id);
    $title = escapeString($conn, $data['title']);
    $description = escapeString($conn, $data['description']);
    $category = escapeString($conn, $data['category']);
    $is_featured = isset($data['is_featured']) ? 1 : 0;
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $imageUpdate = "";
    if ($imagePath) {
        $image = escapeString($conn, $imagePath);
        $imageUpdate = ", image = '$image'";
    }
    
    $sql = "UPDATE gallery SET 
            title = '$title',
            description = '$description',
            category = '$category',
            is_featured = $is_featured,
            is_active = $is_active,
            display_order = $display_order,
            updated_at = CURRENT_TIMESTAMP
            $imageUpdate
            WHERE id = $id";
            
    return $conn->query($sql);
}

// hapus galeri
function deleteGallery($id) {
    global $conn;
    $id = intval($id);
    
    // Ambil data galeri untuk hapus file gambar
    $gallery = getGalleryById($id);
    if ($gallery && $gallery['image'] && file_exists($gallery['image'])) {
        unlink($gallery['image']);
    }
    
    $sql = "DELETE FROM gallery WHERE id = $id";
    return $conn->query($sql);
}

//

//
function getContactInfo() {
    global $conn;
    $sql = "SELECT * FROM contact_info WHERE id = 1";
    $result = fetchOne($conn, $sql);
    return $result ? $result : [];
}

//
function updateContactInfo($data) {
    global $conn;
    
    $phone = escapeString($conn, $data['phone']);
    $whatsapp = escapeString($conn, $data['whatsapp']);
    $email = escapeString($conn, $data['email']);
    $address = escapeString($conn, $data['address']);
    $maps_embed = escapeString($conn, $data['maps_embed']);
    $office_hours = escapeString($conn, $data['office_hours']);
    $facebook = escapeString($conn, $data['facebook']);
    $instagram = escapeString($conn, $data['instagram']);
    $twitter = escapeString($conn, $data['twitter']);
    
    $sql = "UPDATE contact_info SET 
            phone = '$phone',
            whatsapp = '$whatsapp',
            email = '$email',
            address = '$address',
            maps_embed = '$maps_embed',
            office_hours = '$office_hours',
            facebook = '$facebook',
            instagram = '$instagram',
            twitter = '$twitter',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = 1";
            
    return $conn->query($sql);
}

//

//
function getAllFAQ() {
    global $conn;
    $sql = "SELECT * FROM faq WHERE is_active = 1 ORDER BY category ASC, display_order ASC, id ASC";
    return fetchAll($conn, $sql);
}

//
function getFAQById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM faq WHERE id = $id";
    return fetchOne($conn, $sql);
}

//
function addFAQ($data) {
    global $conn;
    
    $question = escapeString($conn, $data['question']);
    $answer = escapeString($conn, $data['answer']);
    $category = escapeString($conn, $data['category']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $sql = "INSERT INTO faq (question, answer, category, is_active, display_order) 
            VALUES ('$question', '$answer', '$category', $is_active, $display_order)";
            
    return $conn->query($sql);
}

//
function updateFAQ($id, $data) {
    global $conn;
    
    $id = intval($id);
    $question = escapeString($conn, $data['question']);
    $answer = escapeString($conn, $data['answer']);
    $category = escapeString($conn, $data['category']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order']);
    
    $sql = "UPDATE faq SET 
            question = '$question',
            answer = '$answer',
            category = '$category',
            is_active = $is_active,
            display_order = $display_order,
            updated_at = CURRENT_TIMESTAMP
            WHERE id = $id";
            
    return $conn->query($sql);
}

//
function deleteFAQ($id) {
    global $conn;
    $id = intval($id);
    $sql = "DELETE FROM faq WHERE id = $id";
    return $conn->query($sql);
}

//

//
function getAllBookings() {
    global $conn;
    $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
    return fetchAll($conn, $sql);
}

//
function getBookingById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM bookings WHERE id = $id";
    return fetchOne($conn, $sql);
}

//
function updateBookingStatus($id, $bookingStatus, $paymentStatus) {
    global $conn;
    
    $id = intval($id);
    $bookingStatus = escapeString($conn, $bookingStatus);
    $paymentStatus = escapeString($conn, $paymentStatus);
    
    $sql = "UPDATE bookings SET 
            booking_status = '$bookingStatus',
            payment_status = '$paymentStatus',
            updated_at = CURRENT_TIMESTAMP
            WHERE id = $id";
            
    return $conn->query($sql);
}

//
function deleteBooking($id) {
    global $conn;
    $id = intval($id);
    $sql = "DELETE FROM bookings WHERE id = $id";
    return $conn->query($sql);
}

//
function generateBookingCode() {
    return 'BK' . date('Ymd') . rand(100, 999);
}

//

//
function uploadImage($file, $targetDir = 'uploads/') {
    // Validasi file upload
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }
    
    // Buat nama file unik
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '_' . date('YmdHis') . '.' . $extension;
    $targetPath = $targetDir . $fileName;
    
    // Buat folder kalau belum ada
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $targetPath;
    }
    
    return false;
}

//

//
function getDashboardStats() {
    global $conn;
    
    $stats = [];
    
    // Total layanan transportasi
    $result = fetchOne($conn, "SELECT COUNT(*) as total FROM transport_services WHERE is_active = 1");
    $stats['total_services'] = $result ? $result['total'] : 0;
    
    // Total galeri
    $result = fetchOne($conn, "SELECT COUNT(*) as total FROM gallery WHERE is_active = 1");
    $stats['total_gallery'] = $result ? $result['total'] : 0;
    
    // Total FAQ
    $result = fetchOne($conn, "SELECT COUNT(*) as total FROM faq WHERE is_active = 1");
    $stats['total_faq'] = $result ? $result['total'] : 0;
    
    return $stats;
}

//

//
function getAllTransportServices() {
    global $conn;
    $sql = "SELECT ts.*, tt.type_name 
            FROM transport_services ts
            LEFT JOIN transport_types tt ON ts.transport_type = tt.type_key
            ORDER BY ts.transport_type, ts.display_order ASC, ts.id DESC";
    return fetchAll($conn, $sql);
}

//
function getTransportServiceById($id) {
    global $conn;
    $id = intval($id);
    $sql = "SELECT * FROM transport_services WHERE id = $id";
    return fetchOne($conn, $sql);
}

//
function getAllTransportTypes() {
    global $conn;
    $sql = "SELECT * FROM transport_types ORDER BY display_order ASC";
    return fetchAll($conn, $sql);
}

//
function addTransportService($data, $logoPath = null) {
    global $conn;
    
    $transport_type = escapeString($conn, $data['transport_type']);
    $name = escapeString($conn, $data['name']);
    $logo = $logoPath ? escapeString($conn, $logoPath) : '';
    $route = escapeString($conn, $data['route']);
    $price = escapeString($conn, $data['price']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order'] ?? 0);
    
    $sql = "INSERT INTO transport_services (transport_type, name, logo, route, price, is_active, display_order) 
            VALUES ('$transport_type', '$name', '$logo', '$route', '$price', $is_active, $display_order)";
            
    return $conn->query($sql);
}

//
function updateTransportService($id, $data, $logoPath = null) {
    global $conn;
    
    $id = intval($id);
    $transport_type = escapeString($conn, $data['transport_type']);
    $name = escapeString($conn, $data['name']);
    $route = escapeString($conn, $data['route']);
    $price = escapeString($conn, $data['price']);
    $is_active = isset($data['is_active']) ? 1 : 0;
    $display_order = intval($data['display_order'] ?? 0);
    
    $logoUpdate = "";
    if ($logoPath) {
        $logo = escapeString($conn, $logoPath);
        $logoUpdate = ", logo = '$logo'";
    }
    
    $sql = "UPDATE transport_services SET 
            transport_type = '$transport_type',
            name = '$name',
            route = '$route',
            price = '$price',
            is_active = $is_active,
            display_order = $display_order,
            updated_at = CURRENT_TIMESTAMP
            $logoUpdate
            WHERE id = $id";
            
    return $conn->query($sql);
}

//
function deleteTransportService($id) {
    global $conn;
    $id = intval($id);
    
    // Ambil data untuk hapus file logo
    $service = getTransportServiceById($id);
    if ($service && $service['logo'] && file_exists($service['logo'])) {
        unlink($service['logo']);
    }
    
    $sql = "DELETE FROM transport_services WHERE id = $id";
    return $conn->query($sql);
}

//

//
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

//
function formatTanggal($tanggal) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $timestamp = strtotime($tanggal);
    $hari = date('d', $timestamp);
    $bulan = $bulan[date('n', $timestamp)];
    $tahun = date('Y', $timestamp);
    
    return $hari . ' ' . $bulan . ' ' . $tahun;
}

//
function truncateText($text, $length = 100) {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . '...';
    }
    return $text;
}
?>

