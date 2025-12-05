<?php
/**
 * HALAMAN GALERI - CV. CENDANA TRAVEL
 */

$companyInfoData = [
    'name' => 'CV. Cendana Travel',
    'whatsapp' => '6285821841529',
    'instagram' => '@cendanatravel_official',
    'email' => 'info@cendanatravel.com',
    'address' => 'Jl. Cendana No.8, Tlk. Lerong Ulu, Kec. Sungai Kunjang<br>Kota Samarinda, Kalimantan Timur 75127',
    'hours' => 'Senin - Minggu: 08.00 - 22.00 WIB',
    'description' => 'Kami adalah penyedia layanan travel terpercaya dengan pengalaman lebih dari 10 tahun dalam melayani perjalanan Anda.'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - <?php echo htmlspecialchars($companyInfoData['name']); ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="icons.css">
</head>
<body class="page-galeri">
    <!-- Header Navigation -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo"><?php echo htmlspecialchars($companyInfoData['name']); ?></a>
            
            <nav>
                <ul class="nav-menu">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="pemesanan.php">Pemesanan</a></li>
                    <li><a href="galeri.php" class="active">Galeri</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </nav>
            
            <div class="header-controls">
                <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="wa-header-btn" target="_blank" title="Hubungi via WhatsApp">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="wa-icon">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.488"/>
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <div class="mobile-menu" title="Menu">
                    <i class="icon icon-menu"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home" style="min-height: 500px; margin-top: 70px;">
        <div class="hero-overlay">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title" style="font-size: 3rem;">
                        Galeri Perjalanan
                    </h1>
                    <p class="hero-description">
                        Koleksi momen indah dari perjalanan pelanggan kami ke berbagai destinasi menakjubkan. Lihat pengalaman nyata dan fasilitas yang kami tawarkan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="section-header">
                <h2>Koleksi Foto & Video</h2>
                <p>Jelajahi momen-momen istimewa dari perjalanan bersama kami</p>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs" style="margin-bottom: var(--spacing-2xl);">
                <button class="filter-tab active" data-filter="all" onclick="filterGallery('all')">
                    <i class="icon icon-th"></i>
                    Semua
                </button>
                <button class="filter-tab" data-filter="kantor" onclick="filterGallery('kantor')">
                    <i class="icon icon-building"></i>
                    Kantor
                </button>
                <button class="filter-tab" data-filter="fasilitas" onclick="filterGallery('fasilitas')">
                    <i class="icon icon-star"></i>
                    Fasilitas
                </button>
                <button class="filter-tab" data-filter="layanan" onclick="filterGallery('layanan')">
                    <i class="icon icon-heart"></i>
                    Layanan
                </button>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <!-- Gallery Item 1 -->
                <article class="gallery-item" data-category="kantor">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Kantor Pusat">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Kantor Pusat Kami</h3>
                            <p>Lokasi strategis di Samarinda</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 2 -->
                <article class="gallery-item" data-category="fasilitas">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Ruang Kerja">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Area Tunggu Nyaman</h3>
                            <p>Fasilitas lengkap dengan AC</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 3 -->
                <article class="gallery-item" data-category="layanan">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Tim Profesional">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Tim Profesional</h3>
                            <p>Siap melayani Anda</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 4 -->
                <article class="gallery-item" data-category="fasilitas">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Layanan Booking">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Sistem Booking Modern</h3>
                            <p>Mudah dan terpercaya</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 5 -->
                <article class="gallery-item" data-category="layanan">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Konsultasi">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Konsultasi Gratis</h3>
                            <p>Kami siap membantu</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 6 -->
                <article class="gallery-item" data-category="kantor">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Meeting Room">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Ruang Rapat</h3>
                            <p>Untuk acara dan pertemuan</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 7 -->
                <article class="gallery-item" data-category="fasilitas">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="WiFi Gratis">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>WiFi Gratis</h3>
                            <p>Akses internet cepat</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 8 -->
                <article class="gallery-item" data-category="layanan">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Customer Service">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Pelayanan Terbaik</h3>
                            <p>Kepuasan pelanggan adalah prioritas</p>
                        </div>
                    </div>
                </article>

                <!-- Gallery Item 9 -->
                <article class="gallery-item" data-category="kantor">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Lobby">
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-content">
                            <h3>Lobby Utama</h3>
                            <p>Pintu masuk yang elegan</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="background: var(--color-primary); color: white; padding: var(--spacing-3xl) 0;">
        <div class="container" style="text-align: center;">
            <h2 style="color: white; margin-bottom: var(--spacing-lg);">Ingin Melihat Lebih Banyak?</h2>
            <p style="color: rgba(255, 255, 255, 0.9); margin-bottom: var(--spacing-2xl); font-size: 1.1rem;">
                Ikuti media sosial kami untuk update terbaru dan promosi menarik
            </p>
            <div style="display: flex; gap: var(--spacing-lg); justify-content: center; flex-wrap: wrap;">
                <a href="https://instagram.com/<?php echo str_replace('@', '', htmlspecialchars($companyInfoData['instagram'])); ?>" class="btn-hero btn-hero-primary" target="_blank">
                    <i class="icon icon-camera"></i> Follow Instagram
                </a>
                <a href="pemesanan.php" class="btn-hero" style="background: rgba(255, 255, 255, 0.2); border: 2px solid white; color: white;">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Premium -->
    <footer class="footer-premium">
        <div class="container">
            <!-- Main Grid: 4 Kolom -->
            <div class="footer-grid-premium">
                
                <!-- KOLOM 1: Tentang Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Tentang Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <p class="footer-text-premium">
                        <?php echo htmlspecialchars($companyInfoData['description']); ?>
                    </p>
                    <div class="footer-hours-box">
                        <p class="footer-label-premium">Jam Operasional:</p>
                        <p class="footer-text-premium">
                            <?php echo htmlspecialchars($companyInfoData['hours']); ?>
                        </p>
                    </div>
                </section>

                <!-- KOLOM 2: Menu Cepat -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Menu Cepat</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="pemesanan.php">Pemesanan</a></li>
                        <li><a href="galeri.php">Galeri</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </section>

                <!-- KOLOM 3: Layanan Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Layanan Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <ul class="footer-links-premium">
                        <li><a href="#">Paket Liburan</a></li>
                        <li><a href="#">Tiket Pesawat</a></li>
                        <li><a href="#">Hotel & Akomodasi</a></li>
                        <li><a href="#">Tour Guide</a></li>
                    </ul>
                </section>

                <!-- KOLOM 4: Hubungi Kami -->
                <section class="footer-section-premium">
                    <h3 class="footer-heading-premium">Hubungi Kami</h3>
                    <div class="footer-separator-premium"></div>
                    <div class="footer-contact-item">
                        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="footer-link-contact">📱 WhatsApp</a>
                    </div>
                    <div class="footer-contact-item">
                        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" class="footer-link-contact"><?php echo htmlspecialchars($companyInfoData['whatsapp']); ?></a>
                    </div>
                    <div class="footer-contact-item">
                        <a href="mailto:<?php echo htmlspecialchars($companyInfoData['email']); ?>" class="footer-link-contact">📧 Email</a>
                    </div>
                    <div class="footer-contact-item">
                        <p class="footer-label-premium">Alamat:</p>
                        <p class="footer-text-premium"><?php echo htmlspecialchars($companyInfoData['address']); ?></p>
                    </div>
                </section>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom-premium">
                <p class="footer-copyright-premium">
                    &copy; 2024 <?php echo htmlspecialchars($companyInfoData['name']); ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <div class="wa-float">
        <a href="https://wa.me/<?php echo htmlspecialchars($companyInfoData['whatsapp']); ?>" target="_blank">
            <i class="icon icon-whatsapp"></i>
        </a>
    </div>

    <script>
        function filterGallery(category) {
            const items = document.querySelectorAll('.gallery-item');
            const tabs = document.querySelectorAll('.filter-tab');
            
            // Update active tab
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.closest('.filter-tab').classList.add('active');
            
            // Filter items
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                    setTimeout(() => item.style.opacity = '1', 0);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.style.display = 'none', 300);
                }
            });
        }
    </script>
    <script src="config.js"></script>
    <script src="script.js"></script>
</body>
</html>
