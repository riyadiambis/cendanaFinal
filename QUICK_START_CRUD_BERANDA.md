# 🚀 QUICK START - CRUD KONTEN BERANDA

## ⚡ 3 Langkah Cepat

### 1️⃣ Import Database
```bash
mysql -u root -p nama_database < database_home_sections_v2.sql
```

### 2️⃣ Buat Folder Upload
```bash
mkdir -p uploads/home
chmod 755 uploads/home
```

### 3️⃣ Akses Admin
```
http://your-domain.com/admin_beranda.php
```

**Login:** admin / admin123

---

## 📝 4 Section yang Bisa Dikontrol

### 1. Hero Section ✨
**Apa:** Header utama halaman beranda  
**Bisa diubah:**
- ✅ Judul utama
- ✅ Sub judul
- ✅ Deskripsi
- ✅ Background image

**Cara:** Edit form → Upload foto (optional) → Simpan

---

### 2. Mengapa Memilih Kami 🎯
**Apa:** 3 Alasan mengapa pelanggan memilih CV. Cendana Travel  
**Bisa diubah:**
- ✅ Tambah/Edit/Hapus item
- ✅ Upload foto per item
- ✅ Set icon Font Awesome
- ✅ Atur urutan

**Cara:**
- **Tambah:** Klik "+ Tambah Item" → Isi form → Upload foto → Simpan
- **Edit:** Klik "Edit" pada item → Ubah → Simpan
- **Hapus:** Klik "Hapus" → Konfirmasi

---

### 3. Bagaimana Cara Memesan 📋
**Apa:** 3 Langkah cara memesan tiket  
**Bisa diubah:**
- ✅ Tambah/Edit/Hapus langkah
- ✅ Upload foto per langkah
- ✅ Set nomor langkah
- ✅ Set icon

**Cara:**
- **Tambah:** Klik "+ Tambah Langkah" → Isi form → Upload foto → Simpan
- **Edit:** Klik "Edit" → Ubah → Simpan
- **Hapus:** Klik "Hapus" → Konfirmasi

---

### 4. Galeri Perjalanan 🖼️
**Apa:** Tampilkan maksimal 3 foto dari galeri utama  
**Bisa diubah:**
- ✅ Edit konten section (judul, deskripsi, tombol)
- ✅ Pilih 3 foto dari galeri
- ✅ Hapus foto dari beranda

**Cara:**
- **Edit konten:** Edit form → Simpan
- **Pilih foto:** Klik "Pilih Foto dari Galeri" → Klik max 3 foto → Tambahkan
- **Hapus foto:** Klik "Hapus dari Beranda" pada foto

---

## 💡 Tips Cepat

### Upload Foto
- **Format:** JPG, PNG, WEBP
- **Ukuran:** Max 2MB recommended
- **Dimensi:** 800x600px optimal

### Icon Font Awesome
Cek icon di: https://fontawesome.com/icons

**Contoh popular:**
```
fas fa-check-circle    → ✓ Check
fas fa-shield-alt      → 🛡️ Shield
fas fa-certificate     → 🎓 Sertifikat
fas fa-headset         → 🎧 Headset
fas fa-search          → 🔍 Search
fas fa-comments        → 💬 Chat
fas fa-credit-card     → 💳 Kartu
```

### Best Practices
- **Hero:** Judul max 5 kata, deskripsi max 2 kalimat
- **Why Choose:** Max 3-4 item, deskripsi singkat & jelas
- **Booking Steps:** 3 langkah optimal, deskripsi step-by-step
- **Gallery:** Pilih foto berkualitas tinggi & bervariasi

---

## 🐛 Quick Troubleshooting

### Foto tidak terupload?
```bash
# Check & fix permissions
chmod 755 uploads/home
```

### Error saat simpan?
1. Cek database sudah diimport
2. Cek koneksi database di `config/database.php`
3. Lihat error di browser console (F12)

### Foto tidak muncul di frontend?
1. Pastikan path foto benar
2. Clear cache browser (Ctrl+Shift+R)
3. Cek file ada di `uploads/home/`

---

## 📊 Files Structure

```
Website-Cendana/
├── admin_beranda.php              ← Halaman admin CRUD
├── admin_beranda.js               ← JavaScript handling
├── database_home_sections_v2.sql  ← Database schema
├── includes/
│   └── home_sections_functions.php ← PHP functions
└── uploads/
    └── home/                       ← Folder upload foto
```

---

## ✅ Checklist

- [ ] Database diimport
- [ ] Folder uploads/home ada & writable
- [ ] Bisa login admin
- [ ] Bisa upload foto
- [ ] Bisa edit Hero Section
- [ ] Bisa CRUD "Mengapa Memilih Kami"
- [ ] Bisa CRUD "Bagaimana Cara Memesan"
- [ ] Bisa pilih foto galeri
- [ ] Konten muncul di frontend

---

## 🎯 Quick Commands

### Create folder & set permissions
```bash
mkdir -p uploads/home
chmod 755 uploads
chmod 755 uploads/home
```

### Import database (MySQL)
```bash
mysql -u username -p database_name < database_home_sections_v2.sql
```

### Import database (phpMyAdmin)
1. Login phpMyAdmin
2. Select database
3. Import → Choose file
4. Execute

### Backup database
```bash
mysqldump -u username -p database_name home_hero_section home_why_choose_us home_booking_steps home_gallery_selection home_gallery_section > backup.sql
```

---

## 🔗 Related Files

- **Full Documentation:** `DOKUMENTASI_CRUD_BERANDA.md`
- **Database Schema:** `database_home_sections_v2.sql`
- **Functions:** `includes/home_sections_functions.php`
- **Admin Page:** `admin_beranda.php`
- **JavaScript:** `admin_beranda.js`

---

## 💬 Quick Reference

### Admin URL
```
http://your-domain.com/admin_beranda.php
```

### Login Credentials
```
Username: admin
Password: admin123
```

### Upload Directory
```
uploads/home/
```

### Max Gallery Photos
```
3 photos maximum
```

---

**Ready to use! 🎉**

Ikuti 3 langkah di atas dan sistem CRUD sudah siap digunakan!
