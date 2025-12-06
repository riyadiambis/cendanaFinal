# 📝 DOKUMENTASI CRUD KONTEN BERANDA

## 🎯 Overview

Sistem CRUD untuk mengelola konten halaman Beranda Pelanggan CV. Cendana Travel. Admin dapat mengelola 4 section utama:

1. **Hero Section** - Jelajahi Dunia, Kapan Saja & Dimana Saja
2. **Mengapa Memilih Kami** - 3 Alasan dengan foto dan konten
3. **Bagaimana Cara Memesan** - 3 Langkah dengan foto dan konten
4. **Galeri Perjalanan** - Pilih maksimal 3 foto dari galeri

---

## 📦 Files yang Dibuat

### 1. Database Schema
**File:** `database_home_sections_v2.sql`

Tabel yang dibuat:
- `home_hero_section` - Hero section content
- `home_why_choose_us` - Alasan memilih kami
- `home_booking_steps` - Langkah pemesanan
- `home_gallery_selection` - Foto galeri terpilih
- `home_gallery_section` - Konten section galeri

### 2. PHP Functions
**File:** `includes/home_sections_functions.php`

Functions untuk CRUD:
- Hero Section: `getHeroSection()`, `updateHeroSection()`, `createHeroSection()`
- Why Choose Us: `getAllWhyChooseUs()`, `createWhyChooseUs()`, `updateWhyChooseUs()`, `deleteWhyChooseUs()`
- Booking Steps: `getAllBookingSteps()`, `createBookingStep()`, `updateBookingStep()`, `deleteBookingStep()`
- Gallery: `getHomeGallerySelection()`, `addGalleryToHome()`, `removeGalleryFromHome()`

### 3. Admin Interface
**File:** `admin_beranda.php`

Halaman admin untuk mengelola semua konten beranda dengan interface yang user-friendly.

### 4. JavaScript
**File:** `admin_beranda.js`

Handle form submissions, modals, dan AJAX operations.

---

## 🚀 Cara Instalasi

### Step 1: Import Database
```bash
mysql -u username -p database_name < database_home_sections_v2.sql
```

Atau via phpMyAdmin:
1. Buka phpMyAdmin
2. Pilih database
3. Tab "Import"
4. Upload file `database_home_sections_v2.sql`
5. Klik "Go"

### Step 2: Buat Folder Upload
```bash
mkdir -p uploads/home
chmod 755 uploads/home
```

### Step 3: Akses Halaman Admin
```
http://your-domain.com/admin_beranda.php
```

Login credentials:
- Username: admin
- Password: admin123

---

## 📚 Panduan Penggunaan

### 1. Hero Section (Jelajahi Dunia)

**Apa yang bisa diubah:**
- Judul Utama (Main Title)
- Sub Judul (Subtitle)
- Deskripsi
- Background Image (optional)

**Cara edit:**
1. Scroll ke section "Hero Section"
2. Edit field yang diinginkan
3. Upload foto background (optional)
4. Klik "Simpan Hero Section"

**Format foto:**
- Format: JPG, JPEG, PNG, GIF, WEBP
- Ukuran recommended: 1920x1080px
- Max size: Sesuai setting PHP

---

### 2. Mengapa Memilih Kami

**Fitur:**
- Tambah item baru (max unlimited, tapi disarankan 3)
- Edit item yang ada
- Hapus item
- Upload foto per item
- Set icon Font Awesome
- Atur urutan tampil

**Cara tambah item baru:**
1. Klik "Tambah Item"
2. Isi form:
   - Judul (contoh: Legal & Terpercaya)
   - Deskripsi
   - Icon Class (contoh: fas fa-certificate)
   - Urutan Tampil (0, 1, 2, dst)
   - Upload Foto (optional)
3. Klik "Simpan"

**Cara edit item:**
1. Klik tombol "Edit" pada item
2. Ubah data yang diinginkan
3. Upload foto baru (optional, foto lama akan tetap jika tidak diupload)
4. Klik "Simpan"

**Cara hapus item:**
1. Klik tombol "Hapus" pada item
2. Konfirmasi penghapusan
3. Item dan fotonya akan dihapus

**Icon Font Awesome:**
Lihat icon di: https://fontawesome.com/icons
Contoh:
- `fas fa-certificate` - Sertifikat
- `fas fa-shield-alt` - Shield
- `fas fa-headset` - Headset
- `fas fa-check-circle` - Check circle

---

### 3. Bagaimana Cara Memesan

**Fitur:**
- Tambah langkah baru (disarankan max 3-4 langkah)
- Edit langkah yang ada
- Hapus langkah
- Upload foto per langkah
- Set nomor langkah
- Set icon Font Awesome

**Cara tambah langkah:**
1. Klik "Tambah Langkah"
2. Isi form:
   - Nomor Langkah (1, 2, 3, dst)
   - Judul (contoh: Pilih Layanan)
   - Deskripsi lengkap
   - Icon Class (contoh: fas fa-search)
   - Upload Foto (optional)
3. Klik "Simpan"

**Cara edit langkah:**
1. Klik "Edit" pada langkah yang ingin diubah
2. Edit data yang diperlukan
3. Upload foto baru jika perlu
4. Klik "Simpan"

**Cara hapus langkah:**
1. Klik "Hapus" pada langkah
2. Konfirmasi penghapusan

**Tips:**
- Gunakan nomor langkah berurutan (1, 2, 3)
- Deskripsi harus jelas dan informatif
- Foto akan membuat langkah lebih menarik

---

### 4. Galeri Perjalanan

**Fitur:**
- Edit konten section galeri
- Pilih maksimal 3 foto dari galeri utama
- Hapus foto dari beranda
- Atur urutan foto

**Cara edit konten galeri:**
1. Scroll ke "Galeri Perjalanan"
2. Edit:
   - Judul Section
   - Deskripsi
   - Teks Tombol
   - Link Tombol
3. Klik "Simpan Konten Galeri"

**Cara pilih foto untuk beranda:**
1. Klik "Pilih Foto dari Galeri"
2. Modal akan terbuka menampilkan semua foto
3. Klik foto yang ingin ditampilkan (max 3)
4. Foto terpilih akan memiliki border hijau
5. Klik "Tambahkan ke Beranda"

**Cara hapus foto dari beranda:**
1. Pada foto yang ingin dihapus
2. Klik "Hapus dari Beranda"
3. Konfirmasi penghapusan

**Catatan:**
- Maksimal 3 foto
- Foto diambil dari Galeri utama
- Hapus foto hanya menghapus dari beranda, tidak dari galeri
- Pastikan sudah ada foto di galeri sebelum memilih

---

## 🔧 Troubleshooting

### Error: "Gagal upload foto"

**Solusi:**
1. Periksa folder `uploads/home/` ada dan writable:
   ```bash
   chmod 755 uploads/home
   ```
2. Periksa setting PHP:
   - `upload_max_filesize` di php.ini
   - `post_max_size` di php.ini
3. Format file harus JPG, JPEG, PNG, GIF, atau WEBP

### Error: "Terjadi kesalahan saat menyimpan"

**Solusi:**
1. Periksa koneksi database
2. Pastikan tabel sudah diimport
3. Periksa console browser (F12) untuk error detail

### Foto tidak muncul di frontend

**Solusi:**
1. Pastikan path foto benar
2. Periksa permissions folder uploads
3. Clear browser cache
4. Periksa file benar-benar ada di server

### Maksimal 3 foto galeri tidak berfungsi

**Solusi:**
1. Hapus dulu foto lama sebelum tambah baru
2. Refresh halaman admin
3. Cek database: `SELECT COUNT(*) FROM home_gallery_selection WHERE is_active = 1`

---

## 💡 Best Practices

### Foto

1. **Ukuran Optimal:**
   - Hero Background: 1920x1080px
   - Why Choose Us: 800x600px
   - Booking Steps: 800x600px
   - Gallery: 1200x800px

2. **Format:**
   - Gunakan JPG untuk foto
   - Gunakan PNG untuk icon/graphic
   - Gunakan WEBP untuk file size lebih kecil

3. **Optimisasi:**
   - Compress foto sebelum upload
   - Target file size < 500KB
   - Tools: TinyPNG, Compressor.io

### Konten

1. **Hero Section:**
   - Judul singkat dan menarik (max 5 kata)
   - Sub judul deskriptif (max 8 kata)
   - Deskripsi jelas (max 2 kalimat)

2. **Mengapa Memilih Kami:**
   - Maksimal 3-4 item
   - Judul singkat (2-3 kata)
   - Deskripsi jelas dan convincing
   - Gunakan icon yang relevan

3. **Bagaimana Cara Memesan:**
   - 3 langkah adalah optimal
   - Judul action-oriented
   - Deskripsi step-by-step
   - Gunakan nomor berurutan

4. **Galeri:**
   - Pilih foto berkualitas tinggi
   - Foto yang representatif
   - Variasi kategori (transport, destinasi, dll)

### SEO & Performance

1. **Alt Text:** Berikan nama file foto yang deskriptif
2. **Loading:** Lazy load foto jika banyak
3. **CDN:** Gunakan CDN untuk foto jika traffic tinggi
4. **Cache:** Enable browser caching

---

## 🔒 Security

### Upload File

1. **Validasi tipe file** - Hanya allow JPG, PNG, GIF, WEBP
2. **Rename file** - Generate unique filename
3. **File size limit** - Max sesuai setting PHP
4. **Folder permissions** - 755 untuk folder, 644 untuk file

### Database

1. **Prepared statements** - Semua query menggunakan prepared statements
2. **Input validation** - Semua input divalidasi
3. **XSS prevention** - htmlspecialchars() untuk output
4. **SQL Injection prevention** - bind_param() untuk queries

### Admin Access

1. **Session check** - Setiap page check admin session
2. **CSRF protection** - (Disarankan tambahkan CSRF token)
3. **Password hash** - Password admin di-hash (bcrypt)

---

## 📊 Database Schema Detail

### home_hero_section
```sql
id INT PRIMARY KEY
main_title VARCHAR(255)
sub_title VARCHAR(255)
description TEXT
background_image VARCHAR(255)
is_active TINYINT(1)
updated_at TIMESTAMP
created_at TIMESTAMP
```

### home_why_choose_us
```sql
id INT PRIMARY KEY
title VARCHAR(255)
description TEXT
image VARCHAR(255)
icon_class VARCHAR(100)
display_order INT
is_active TINYINT(1)
updated_at TIMESTAMP
created_at TIMESTAMP
```

### home_booking_steps
```sql
id INT PRIMARY KEY
step_number INT
title VARCHAR(255)
description TEXT
image VARCHAR(255)
icon_class VARCHAR(100)
is_active TINYINT(1)
updated_at TIMESTAMP
created_at TIMESTAMP
```

### home_gallery_selection
```sql
id INT PRIMARY KEY
gallery_id INT (FOREIGN KEY)
display_order INT
is_active TINYINT(1)
updated_at TIMESTAMP
created_at TIMESTAMP
```

### home_gallery_section
```sql
id INT PRIMARY KEY
title VARCHAR(255)
description TEXT
button_text VARCHAR(100)
button_link VARCHAR(255)
is_active TINYINT(1)
updated_at TIMESTAMP
created_at TIMESTAMP
```

---

## 🎨 Customization

### Mengubah Maksimal Galeri (dari 3 ke angka lain)

**File:** `includes/home_sections_functions.php`

Cari baris:
```php
if ($count >= 3) {
    return false; // Max limit reached
}
```

Ubah angka 3 ke angka yang diinginkan.

### Mengubah Upload Directory

**File:** `includes/home_sections_functions.php`

Cari fungsi `uploadHomeImage()`:
```php
function uploadHomeImage($file, $directory = 'uploads/home/') {
```

Ubah `'uploads/home/'` ke directory yang diinginkan.

### Menambah Validasi File Type

**File:** `includes/home_sections_functions.php`

Cari baris:
```php
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
```

Tambah atau kurangi tipe file yang diizinkan.

---

## 🔄 Update & Maintenance

### Backup Database

```bash
mysqldump -u username -p database_name home_hero_section home_why_choose_us home_booking_steps home_gallery_selection home_gallery_section > backup_home_sections.sql
```

### Restore Database

```bash
mysql -u username -p database_name < backup_home_sections.sql
```

### Update Schema

Jika ada perubahan schema:
1. Export data existing
2. Drop tables
3. Import schema baru
4. Import data kembali

---

## 📞 Support

Jika ada kendala:
1. Periksa error log PHP
2. Periksa console browser (F12)
3. Periksa database logs
4. Backup dulu sebelum troubleshoot
5. Test di staging environment dulu

---

## ✅ Checklist Go-Live

- [ ] Import database schema
- [ ] Buat folder uploads/home
- [ ] Set permissions folders
- [ ] Test upload foto
- [ ] Test CRUD semua section
- [ ] Test galeri selection
- [ ] Verify foto muncul di frontend
- [ ] Test responsive display
- [ ] Backup database
- [ ] Monitor error logs

---

**Version:** 1.0  
**Created:** December 6, 2025  
**Last Updated:** December 6, 2025  
**Status:** Production Ready ✅
