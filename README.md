Sistem Gudang - Laravel Sail & Docker

## Tentang

Sistem Gudang adalah aplikasi manajemen gudang sederhana yang dibangun dengan Laravel 10 menggunakan Docker dan Sail. Aplikasi ini menyediakan API untuk mengelola barang, pengguna, dan mutasi.

## Fitur Utama

- Manajemen barang (CRUD)
- Manajemen pengguna (CRUD)
- Riwayat mutasi barang dan pengguna
- Otentikasi menggunakan Laravel Sanctum
- Output dalam format JSON

## Persyaratan

- Docker
- Docker Compose
- Git
- WSL2 (untuk pengguna Windows)

### Instalasi Lokal

1. Clone Repository
Clone repository ini ke lokal atau server Anda:
>git clone https://github.com/wewaits/sistem-gudang.git
>cd sistem-gudang

2. Salin File .env
Salin file .env.example menjadi .env dan sesuaikan dengan konfigurasi Anda:
>cp .env.example .env

Perbarui bagian koneksi database di .env jika diperlukan:
>DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=sistem_gudang
DB_USERNAME=sail
DB_PASSWORD=password

3. Install Dependencies
Jalankan perintah di bawah ini untuk menginstal semua dependency dengan Composer:
>docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install

4. Jalankan Laravel Sail
Gunakan Laravel Sail untuk menghidupkan kontainer Docker:
>./vendor/bin/sail up -d

5. Jalankan Migrasi dan Seeder
Setelah kontainer berjalan, jalankan migrasi dan seeder untuk membuat tabel dan memasukkan data awal:
>./vendor/bin/sail artisan migrate --seed

6. Generate Application Key
Jalankan perintah berikut untuk menghasilkan application key Laravel:
>./vendor/bin/sail artisan key:generate

7. Akses Aplikasi
Setelah instalasi selesai, Anda dapat mengakses aplikasi pada http://localhost jika berjalan secara lokal, atau IP/server domain Anda jika di server.

### Deployment ke Server (Production)

1. Persiapan Server
Pastikan server memiliki Docker dan Docker Compose terinstal.

2. Salin Project ke Server
Clone project ke server atau gunakan scp untuk mengirim file project dari lokal ke server:
>git clone https://github.com/yourusername/sistem-gudang.git
>cd sistem-gudang

3. Perbarui Konfigurasi .env
Sesuaikan konfigurasi di file .env untuk production:
>APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-production-domain.com
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=sistem_gudang_prod
DB_USERNAME=sail
DB_PASSWORD=secure_password

4. Bangun dan Jalankan Kontainer
Jalankan Docker Compose untuk memulai aplikasi di server production:
>./vendor/bin/sail up -d

5. Jalankan Migrasi
Setelah kontainer aktif, jalankan migrasi untuk production:
>./vendor/bin/sail artisan migrate --force

6. Pengaturan File Permissions
Pastikan Laravel memiliki akses yang benar ke direktori penyimpanan dan cache:
>./vendor/bin/sail artisan storage:link

7. Pengelolaan Kontainer
Menghentikan Kontainer:
>./vendor/bin/sail down

## Pengujian API

Gunakan Postman atau API client lainnya untuk menguji endpoint API. Semua endpoint API menggunakan otentikasi Bearer Token.
- **[Dokumentasi API](https://documenter.getpostman.com/view/4879233/2sAXqwYKse)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
