# Literabit

Literabit adalah aplikasi web literasi anak yang dirancang untuk membantu anak membaca buku digital, sekaligus memungkinkan orang tua memantau progres membaca melalui dashboard.

Aplikasi ini dibangun sebagai latihan pengembangan aplikasi web berbasis PHP dan MySQL, dengan fokus pada pengelolaan data, autentikasi pengguna, dan pencatatan aktivitas membaca.

---

## 🎯 Tujuan Proyek
- Menyediakan platform membaca buku digital untuk anak
- Memberikan fitur monitoring aktivitas membaca bagi orang tua
- Menerapkan konsep CRUD, autentikasi, dan relasi data dalam aplikasi web

---

## ✨ Fitur Utama
### Untuk Anak
- Membaca buku digital
- Menyimpan halaman terakhir yang dibaca
- Mengerjakan kuis setelah membaca buku

### Untuk Orang Tua
- Dashboard orang tua
- Melihat riwayat membaca anak
- Memantau progres membaca

### Umum
- Sistem login dan registrasi
- Manajemen data buku
- Pencatatan histori membaca

---

## 🛠️ Teknologi yang Digunakan
- PHP
- MySQL
- HTML
- CSS
- JavaScript

---

## 🗂️ Struktur Data (Ringkas)
Beberapa tabel utama yang digunakan:
- **users** – data akun pengguna
- **books** – data buku digital
- **histories** – progres membaca (halaman terakhir, status)

---

## ⚙️ Setup Environment
Proyek ini menggunakan file environment untuk konfigurasi aplikasi.

### 1. Salin file `.env.example`
```bash
cp .env.example .env
