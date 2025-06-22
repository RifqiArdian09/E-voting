# 🗳️ E-Voting OSIS

Aplikasi pemilihan Ketua OSIS berbasis web dengan sistem voting yang **aman**, **mudah digunakan**, dan **real-time**.

## ✨ Fitur Utama

- ✅ Voting online dengan **token unik** per pemilih  
- 👤 Tampilan kandidat lengkap dengan **foto, visi & misi**  
- 📊 **Hasil voting real-time** dengan grafik interaktif  
- ⏳ Pengaturan **batas waktu voting** yang fleksibel  
- 🔐 Sistem **satu pemilih satu suara**  
- ⚙️ Panel admin (Filament) untuk **manajemen data kandidat & pemilih**

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12  
- **Frontend**: Tailwind CSS, Alpine.js  
- **Admin Panel**: Filament PHP  
- **Database**: MySQL  


## ⚙️ Setup Guide

### 1. Clone project
```bash
https://github.com/RifqiArdian09/E-voting.git
cd E-voting
```
### 2. Copy file .env.example
```bash
copy .env.example .env
```

### 3. Setup database pada komputer anda, lalu masukkan kredensial-kredensialnya ke file .env.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_evoting
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install dependency
```bash
composer install
```
### 5. Generate application key
```bash
php artisan key:generate
```
### 6. Link storage untuk file upload
```bash
php artisan storage:link

```
### 7. Migrasi database
```bash
php artisan migrate
```
### 8. Jalankan aplikasi
```bash
php artisan serve
```

### 9. Buat akun admin untuk Filament
```bash
php artisan make:filament-user
```
