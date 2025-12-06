-- ============================================
-- DATABASE SCHEMA UNTUK CRUD BERANDA PELANGGAN V2
-- Sesuai dengan tampilan baru di screenshot
-- ============================================

-- DROP TABLES LAMA (Uncomment jika perlu reset)
-- DROP TABLE IF EXISTS home_gallery_selection;
-- DROP TABLE IF EXISTS home_booking_steps;
-- DROP TABLE IF EXISTS home_why_choose_us;
-- DROP TABLE IF EXISTS home_hero_section;

-- ============================================
-- 1. HERO SECTION (Jelajahi Dunia, Kapan Saja & Dimana Saja)
-- ============================================
CREATE TABLE IF NOT EXISTS home_hero_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    main_title VARCHAR(255) NOT NULL DEFAULT 'Jelajahi Dunia',
    sub_title VARCHAR(255) NOT NULL DEFAULT 'Kapan Saja & Dimana Saja',
    description TEXT NOT NULL DEFAULT 'Pilih moda transportasi favorit Anda dengan pelayanan premium.',
    background_image VARCHAR(255) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default data
INSERT INTO home_hero_section (main_title, sub_title, description) VALUES
('Jelajahi Dunia', 'Kapan Saja & Dimana Saja', 'Pilih moda transportasi favorit Anda dengan pelayanan premium.');


-- ============================================
-- 2. MENGAPA MEMILIH KAMI (3 Item dengan Foto & Konten)
-- ============================================
CREATE TABLE IF NOT EXISTS home_why_choose_us (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    icon_class VARCHAR(100) DEFAULT 'fas fa-check-circle',
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default data
INSERT INTO home_why_choose_us (title, description, icon_class, display_order) VALUES
('Legal & Terpercaya', 'Perusahaan travel resmi dengan izin operasional lengkap dari badan pemerintah yang kompeten.', 'fas fa-certificate', 1),
('Layanan 24/7', 'Tim customer service yang responsif siap membantu Anda kapan saja, bahkan di hari libur.', 'fas fa-headset', 2),
('Aman & Terjamin', 'Semua transaksi dijamin aman dengan sertifikat keamanan dan perlindungan data pelanggan.', 'fas fa-shield-alt', 3);


-- ============================================
-- 3. BAGAIMANA CARA MEMESAN (3 Langkah dengan Foto & Konten)
-- ============================================
CREATE TABLE IF NOT EXISTS home_booking_steps (
    id INT PRIMARY KEY AUTO_INCREMENT,
    step_number INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    icon_class VARCHAR(100) DEFAULT 'fas fa-1',
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default data
INSERT INTO home_booking_steps (step_number, title, description, icon_class) VALUES
(1, 'Pilih Layanan', 'Kunjungi halaman pemesanan utama kami. Di sana Anda dapat memilih jenis transportasi yang diinginkan (Pesawat, Kapal Laut, atau Bus) sesuai dengan tujuan dan kebutuhan perjalanan Anda.', 'fas fa-search'),
(2, 'Hubungi Admin', 'Setelah memilih layanan, klik tombol "Pesan Sekarang". Isi formulir singkat dan Anda akan diarahkan otomatis ke WhatsApp admin kami untuk konfirmasi ketersediaan dan harga terkini.', 'fas fa-comments'),
(3, 'Lakukan Pembayaran', 'Lakukan transfer pembayaran sesuai instruksi yang diberikan oleh admin. E-tiket resmi akan dikirimkan ke email atau WhatsApp Anda segera setelah pembayaran terkonfirmasi.', 'fas fa-credit-card');


-- ============================================
-- 4. GALERI PERJALANAN (Pilih Maksimal 3 Foto dari Galeri)
-- ============================================
CREATE TABLE IF NOT EXISTS home_gallery_selection (
    id INT PRIMARY KEY AUTO_INCREMENT,
    gallery_id INT NOT NULL,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gallery_id) REFERENCES gallery(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================
-- 5. GALERI SECTION INFO (Konten untuk Galeri Perjalanan)
-- ============================================
CREATE TABLE IF NOT EXISTS home_gallery_section (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL DEFAULT 'Galeri Perjalanan',
    description TEXT NOT NULL DEFAULT 'Temukan inspirasi destinasi wisata terbaik dari koleksi perjalanan kami yang tak terlupakan.',
    button_text VARCHAR(100) DEFAULT 'Lihat Selengkapnya',
    button_link VARCHAR(255) DEFAULT 'galeri.php',
    is_active TINYINT(1) DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default data
INSERT INTO home_gallery_section (title, description, button_text, button_link) VALUES
('Galeri Perjalanan', 'Temukan inspirasi destinasi wisata terbaik dari koleksi perjalanan kami yang tak terlupakan.', 'Lihat Selengkapnya', 'galeri.php');


-- ============================================
-- INDEXES untuk Performance
-- ============================================
CREATE INDEX idx_why_choose_order ON home_why_choose_us(display_order, is_active);
CREATE INDEX idx_booking_steps_number ON home_booking_steps(step_number, is_active);
CREATE INDEX idx_gallery_selection_order ON home_gallery_selection(display_order, is_active);
