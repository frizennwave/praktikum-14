<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# 📰 Web Berita — Praktikum 14

> **Implementasi CRUD Dasar pada Web Berita**
> Membangun fondasi database, migrasi tabel, model relasional, controller terstruktur, dan antarmuka admin modular menggunakan **Laravel 13** + **SB Admin 2**.

---

## 📋 Deskripsi Proyek

Proyek ini merupakan aplikasi **CMS Web Berita** berbasis Laravel 13 yang dijalankan menggunakan **Laravel Sail** (Docker). Panel admin dibangun di atas template Bootstrap **SB Admin 2**. Praktikum ini berfokus pada implementasi CRUD (Create, Read, Update, Delete) untuk tiga entitas utama: **Pengguna**, **Kategori**, dan **Artikel Berita**, beserta relasi antar-tabel menggunakan Eloquent ORM.

---

### Home
![Home](./public/images/home.png)

### Detail
![Detail](./public/images/detail.png)

### Dashboard
![Dashboard](./public/images/dashboard.png)

### Kelola Artikel
![Kelola Artikel](./public/images/kelola_berita.png)

### Kelola User
![Kelola User](./public/images/kelola_user.png)

### Kelola Kategori
![Kelola Kategori](./public/images/kelola_kategori.png)

---

## ✨ Fitur Utama

- 🔐 **Autentikasi** — Login & Register bawaan Laravel UI
- 👤 **CRUD Pengguna** — Tambah, tampil, edit, hapus akun admin/penulis (dengan password hashing & proteksi self-delete)
- 🏷️ **CRUD Kategori** — Manajemen kategori berita dengan auto-generate slug
- 📝 **CRUD Artikel** — Penulisan berita dengan relasi ke kategori dan penulis
- 📊 **Dashboard Admin** — Statistik total pengguna, kategori, dan berita; tabel 5 berita terbaru
- 🔒 **Proteksi Route** — Semua halaman admin dilindungi middleware `auth`

---

## 🗄️ Skema Database

```
USERS ──── has one ──── PROFILES
  │
  └──── has many ──── ARTICLES ──── belongs to ──── CATEGORIES
```

| Tabel        | Kolom Utama                                                                          |
|--------------|--------------------------------------------------------------------------------------|
| `users`      | `id`, `name`, `email`, `password`, `created_at`                                     |
| `profiles`   | `id`, `user_id` (FK), `bio`, `avatar`, `phone`                                      |
| `categories` | `id`, `name`, `slug` (unique)                                                        |
| `articles`   | `id`, `user_id` (FK), `category_id` (FK), `title`, `slug`, `content`, `image`      |

### Relasi Eloquent

- **One-to-One**: `User` ↔ `Profile` (`hasOne` / `belongsTo`)
- **One-to-Many**: `User` → `Article` (`hasMany` / `belongsTo`)
- **One-to-Many**: `Category` → `Article` (`hasMany` / `belongsTo`)

---

## 🗂️ Struktur Direktori Penting

```
praktikum-14/
├── app/
│   ├── Http/Controllers/
│   │   ├── UserController.php
│   │   ├── CategoryController.php
│   │   └── ArticleController.php
│   └── Models/
│       ├── User.php
│       ├── Profile.php
│       ├── Category.php
│       └── Article.php
├── database/
│   └── migrations/
│       ├── ..._create_users_table.php
│       ├── ..._create_profiles_table.php
│       ├── ..._create_categories_table.php
│       └── ..._create_articles_table.php
├── resources/views/
│   └── admin/
│       ├── layouts/app.blade.php
│       ├── dashboard.blade.php
│       ├── users/         (index, create, edit)
│       ├── categories/    (index, create, edit)
│       └── articles/      (index, create, edit)
├── compose.yaml
└── routes/
    └── web.php
```

---

## ⚙️ Persyaratan Sistem

| Komponen   | Versi         |
|------------|---------------|
| PHP        | 8.3 (via Sail)|
| Laravel    | 13.x          |
| Composer   | 2.x           |
| Node.js    | 18.x          |
| Docker     | 20.x+         |
| PostgreSQL | 18 (via Sail) |

---

## 🚀 Cara Instalasi & Menjalankan

### 1. Clone / Ekstrak Proyek

```bash
unzip praktikum-14.zip
cd praktikum-14
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Pastikan konfigurasi berikut ada di file `.env` (sudah sesuai untuk Sail):

```env
APP_NAME=web-berita
APP_URL=http://localhost:8080
APP_PORT=8080

DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=praktikum-14
DB_USERNAME=root
DB_PASSWORD=root
```

### 4. Jalankan Laravel Sail (Docker)

```bash
# Jalankan container di background
./vendor/bin/sail up -d
```

> **Pertama kali?** Jika muncul error karena image belum ada, jalankan `./vendor/bin/sail build` terlebih dahulu.

### 5. Jalankan Migrasi

```bash
./vendor/bin/sail artisan migrate
```

### 6. Install & Build Aset Frontend

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Akses aplikasi di: **http://localhost:8080**

### 7. Menghentikan Sail

```bash
./vendor/bin/sail down
```

---

## 💡 Alias Sail (Opsional)

Agar tidak perlu mengetik `./vendor/bin/sail` setiap saat, tambahkan alias ke shell Anda:

```bash
# Tambahkan ke ~/.bashrc atau ~/.zshrc
alias sail='./vendor/bin/sail'

# Setelah itu reload shell
source ~/.bashrc
```

Penggunaan setelah alias aktif:

```bash
sail up -d
sail artisan migrate
sail artisan tinker
sail down
```

---

## 🌐 Daftar Route

| Method    | URI                            | Controller Action           | Nama Route             |
|-----------|--------------------------------|-----------------------------|------------------------|
| GET       | `/`                            | Closure (index)             | —                      |
| GET       | `/login`                       | Auth\LoginController        | `login`                |
| POST      | `/register`                    | Auth\RegisterController     | `register`             |
| GET       | `/dashboard`                   | Closure (admin.dashboard)   | `dashboard`            |
| GET       | `/admin/users`                 | UserController@index        | `users.index`          |
| GET       | `/admin/users/create`          | UserController@create       | `users.create`         |
| POST      | `/admin/users`                 | UserController@store        | `users.store`          |
| GET       | `/admin/users/{id}/edit`       | UserController@edit         | `users.edit`           |
| PUT/PATCH | `/admin/users/{id}`            | UserController@update       | `users.update`         |
| DELETE    | `/admin/users/{id}`            | UserController@destroy      | `users.destroy`        |
| GET       | `/admin/categories`            | CategoryController@index    | `categories.index`     |
| GET       | `/admin/categories/create`     | CategoryController@create   | `categories.create`    |
| POST      | `/admin/categories`            | CategoryController@store    | `categories.store`     |
| GET       | `/admin/categories/{id}/edit`  | CategoryController@edit     | `categories.edit`      |
| PUT/PATCH | `/admin/categories/{id}`       | CategoryController@update   | `categories.update`    |
| DELETE    | `/admin/categories/{id}`       | CategoryController@destroy  | `categories.destroy`   |
| GET       | `/admin/articles`              | ArticleController@index     | `articles.index`       |
| GET       | `/admin/articles/create`       | ArticleController@create    | `articles.create`      |
| POST      | `/admin/articles`              | ArticleController@store     | `articles.store`       |
| GET       | `/admin/articles/{id}/edit`    | ArticleController@edit      | `articles.edit`        |
| PUT/PATCH | `/admin/articles/{id}`         | ArticleController@update    | `articles.update`      |
| DELETE    | `/admin/articles/{id}`         | ArticleController@destroy   | `articles.destroy`     |

---

## 🔑 Akses Default

Buat akun pertama melalui halaman registrasi:

```
URL Login    : http://localhost:8080/login
URL Register : http://localhost:8080/register
Dashboard    : http://localhost:8080/dashboard
```

---

## 📌 Validasi Form

### Pengguna
- `name` — wajib, maks. 255 karakter
- `email` — wajib, format email, unik
- `password` — wajib (saat buat), min. 8 karakter, harus dikonfirmasi

### Kategori
- `name` — wajib, maks. 255 karakter, unik
- `slug` — digenerate otomatis dari nama menggunakan `Str::slug()`

### Artikel
- `title` — wajib, maks. 255 karakter
- `category_id` — wajib, harus ada di tabel `categories`
- `content` — wajib

---

## 🛡️ Fitur Keamanan

- Password dienkripsi menggunakan `Hash::make()` (bcrypt)
- Admin tidak dapat menghapus akunnya sendiri saat sedang login
- Kategori tidak dapat dihapus jika masih memiliki artikel terikat
- Semua form dilindungi CSRF token (`@csrf`)
- Seluruh route admin dilindungi middleware `auth`

---

## 📚 Teknologi yang Digunakan

| Teknologi       | Keterangan                        |
|-----------------|-----------------------------------|
| Laravel 13      | PHP Framework                     |
| Laravel Sail    | Docker development environment    |
| PostgreSQL 18   | Database (container via Sail)     |
| Laravel UI      | Scaffolding autentikasi           |
| Eloquent ORM    | Database abstraction layer        |
| SB Admin 2      | Bootstrap 4 admin template        |
| Font Awesome    | Icon library                      |
| Vite            | Asset bundler                     |

---

## 👨‍💻 Informasi Praktikum

| Info        | Detail                             |
|-------------|------------------------------------|
| Pertemuan   | 14                                 |
| Topik       | Implementasi CRUD Dasar Web Berita |
| Framework   | Laravel 13 + Laravel Sail          |
| Estimasi    | 120 Menit                          |
| Tingkat     | Pemula – Menengah                  |

## 📝 Lisensi

Proyek ini dibuat untuk keperluan **praktikum akademik** — Pemrograman Web Berbasis Framework, Tahun Ajaran 2025/2026.
