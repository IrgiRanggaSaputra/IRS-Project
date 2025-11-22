# IRS-Project
Sistem Informasi Layanan Konsultasi, Manajemen Proyek, dan Pelatihan

IRS Project adalah aplikasi berbasis web yang dikembangkan untuk menampilkan berbagai layanan perusahaan seperti konsultasi IT, manajemen proyek, serta pelatihan & workshop.  
Project ini dibuat menggunakan **PHP Native**, **Bootstrap 5**, dan **JSON** sebagai penyimpanan data layanan.

Aplikasi juga dilengkapi dengan fitur **login**, **menu utama**, dan halaman detail layanan yang dapat diakses oleh user.

## Fitur utama
- Halaman publik: `index.php`, `layanan.php`, `detail.php` (ambil data dari DB)
- Autentikasi: `login.php`, `register.php`
- Halaman pengguna: `menu.php`, `profil.php`, `riwayat.php`
- CRUD ringan untuk layanan via SQL import (`inserts_layanan.sql`) dan tampilan layanan
- Layout menggunakan Bootstrap 5

---

## Struktur penting
- `index.php` — halaman utama
- `layanan.php` — daftar layanan (mengambil data dari tabel `layanan`)
- `detail.php` — menampilkan detil layanan berdasarkan `id`
- `login.php`, `register.php` — form autentikasi
- `menu.php` — area setelah login (user area)
- `profil.php`, `riwayat.php` — halaman user
- `includes/header.php`, `includes/footer.php` — layout header/footer
- `config.php` — koneksi database (`$conn` sebagai mysqli object)
- `assets/css/style.css` — style kustom
- `inserts_layanan.sql` — contoh data layanan (INSERT)

---

## Database


```sql
CREATE TABLE layanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  image VARCHAR(255) DEFAULT NULL,
  deskripsi TEXT,
  harga INT DEFAULT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);
```

## Fitur Utama

### 1. Landing Page
- Menampilkan banner/hero modern
- Informasi singkat tentang IRS Project
- Daftar layanan diambil dari `info.json`

### 🔹 2. Autentikasi Login
- Sistem login menggunakan session PHP
- Membatasi akses menu utama untuk user yang login
- Tombol logout

### 3. Detail Layanan
Setiap layanan memiliki:
- Gambar layanan
- Tagline
- Deskripsi lengkap
- Ruang lingkup
- Manfaat
- Proses kerja

Semua informasi diambil dari file **JSON** → `data/info.json`

### 4. Menu Utama User
Setelah login, user diarahkan ke dashboard menu utama.

---

## Teknologi yang Digunakan

- PHP Native
- Bootstrap 5 (CDN)
- JSON (data layanan)
- HTML5 & CSS3
- Font Awesome Icons
- Laragon (development environment)

---

## Struktur Folder

```
IRS-Project/
│
├── assets/
│   ├── image/
│   │   ├── irs.png
│   │   ├── consulting.jpg
│   │   ├── manajement.jpg
│   │   ├── pelatihan.png
│   │
|   
│
├── data/
│   └── info.json
│
├── includes/
│   ├── header.php
│   └── footer.php
│
├── index.php
├── detail.php
├── login.php
├── logout.php
├── menu.php
└── README.md
```

## Login System

Setelah login, user diarahkan ke **menu.php** sebagai halaman menu utama.


## Data Layanan (JSON)

Data layanan disimpan di:

```
/data/info.json
```

Contoh struktur JSON:

```json
{
  "id": 1,
  "title": "Layanan Konsultasi IT",
  "summary": "Konsultasi pengembangan sistem informasi dan infrastruktur IT.",
  "tagline": "Solusi profesional untuk pengembangan sistem informasi modern.",
  "image": "assets/image/consulting.jpg",
  "description": "Deskripsi lengkap...",
  "scope": ["Item 1", "Item 2"],
  "benefits": ["Keuntungan 1", "Keuntungan 2"],
  "process": ["Langkah 1", "Langkah 2"]
}
```


## Screenshot 

screenshot halaman utama:

![Halaman Utama](assets/screenshot/index.png)

Layanan IT

![Halaman Utama](assets/screenshot/layanan.png)

Layanan Proyek

![Halaman Utama](assets/screenshot/detail.png)

Menu

![Halaman Utama](assets/screenshot/menu.png)

Login

![Halaman Utama](assets/screenshot/login.png)

Register

![Halaman Utama](assets/screenshot/register.png)

Profil

![Halaman Utama](assets/screenshot/profil.png)

## API

Create

![Halaman Utama](assets/API/create.png)

Update

![Halaman Utama](assets/API/update.png)

Read

![Halaman Utama](assets/API/get.png)

Delete

![Halaman Utama](assets/API/delete.png)

## 👨‍💻 Developer

**Irgi Rangga Saputra**  
IRS Project – Sistem Informasi Layanan  
GitHub: https://github.com/IrgiRanggaSaputra

---

## 📄 Lisensi

Proyek ini bersifat **open-source** dan dapat digunakan untuk pembelajaran serta pengembangan aplikasi web.

