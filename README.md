# Aplikasi Pendaftaran Beasiswa (TUBEL / LPDP App)

Aplikasi berbasis web untuk mengelola proses pendaftaran beasiswa secara terpusat. Dilengkapi dengan sistem registrasi berbasis OTP, formulir pendaftaran 7 tahap (*multi-step wizard*), serta panel kontrol Admin untuk verifikasi, filter, dan pengelolaan status pendaftar (Diterima, Ditolak, Revisi).

## 🚀 Fitur Utama

### 🧑‍🎓 Sisi Pendaftar (User)
* **Autentikasi Aman:** Pendaftaran akun dan login dilengkapi dengan verifikasi OTP (One-Time Password) via Email.
* **Formulir 7 Tahap (*Multi-step Form*):**
  * Tahap 1: Registrasi Data & Upload KTP
  * Tahap 2: Latar Belakang Industri / Pekerjaan
  * Tahap 3: Universitas Tujuan & Dokumen LoA / KHS
  * Tahap 4: Profil & Biodata (Riwayat, Prestasi, Keahlian)
  * Tahap 5: Surat Rekomendasi
  * Tahap 6: Essay Kontribusi
  * Tahap 7: Ringkasan & Kirim (*Finalize*)
* **Fitur Draft:** Data formulir otomatis tersimpan (localStorage/Database) sehingga pendaftar bisa melanjutkan kapan saja.
* **Status Tracking:** Memantau status pendaftaran secara *real-time* (Draft, Pending, Revisi, Diterima, Ditolak).

### 👨‍💼 Sisi Administrator
* **Dashboard Statistik:** Ringkasan total pendaftar, data *pending*, revisi, ditolak, dan diterima.
* **Manajemen Berkas:** Review berkas pendaftar dalam satu layar menggunakan sistem *Tab/Accordion*.
* **Sistem Verifikasi:** * Terima Berkas (Langsung terhubung dengan notifikasi WhatsApp).
  * Tolak Berkas (Memberikan catatan alasan penolakan agar pendaftar dapat melakukan revisi).
* **Informasi Akun:** Tabel daftar seluruh akun pengguna beserta fitur *Search* dan *Filter* untuk memudahkan penelusuran data.

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Laravel Blade, Tailwind CSS, Alpine.js (untuk interaktivitas UI seperti *tabs, dropdowns, dan stepper*)
* **Database:** MySQL / PostgreSQL (didukung oleh Eloquent ORM)
* **Asset Bundler:** Vite

## 📂 Struktur Database Utama
Aplikasi ini memisahkan data pendaftar menjadi beberapa tabel berelasi untuk menjaga performa dan normalisasi data:
* `users` & `user_profiles` (Data Akun & Pribadi)
* `industri_pendukungs` (Data Pekerjaan)
* `universitas_pendaftarans` (Data Akademik)
* `biodata_pendaftarans` (Data CV/Profil)
* `rekomendasi_pendaftarans` (Data Rekomendator)
* `essay_pendaftarans` (Teks Essay)
* `admins` (Akses Panel Admin)
* `otp_codes` (Manajemen OTP Email)

## 💻 Instalasi & Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal (Localhost):

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/username-anda/lpdp-app.git](https://github.com/username-anda/lpdp-app.git)
   cd lpdp-app

2. **Install Dependensi PHP (Composer)i**
    ```bash
    composer install

3. **Install Dependensi Frontend (NPM)**
    ```bash
    npm install

4. **Pengaturan Konfigurasi Lingkungan (.env)**
    ```bash
    cp .env.example .env
    
* Buka file .env dan atur koneksi database Anda (
    DB_DATABASE, DB_USERNAME, DB_PASSWORD).

* Atur kredensial SMTP untuk pengiriman Email OTP 
(MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD).
