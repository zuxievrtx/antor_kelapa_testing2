# Modul Manajemen Data Siswa - Laravel

## Deskripsi
Modul ini menyediakan sistem manajemen data siswa lengkap dengan fitur CRUD untuk jurusan, kelas, dan siswa. Sistem ini juga mengimplementasikan logika bisnis untuk pembuatan akun pengguna secara otomatis dan fitur impor/ekspor data siswa.

## Fitur Utama

### 1. Manajemen Jurusan (Majors)
- CRUD lengkap untuk data jurusan
- Validasi nama singkat jurusan (unique)
- Penghitungan jumlah kelas per jurusan
- Proteksi penghapusan jika masih memiliki kelas

### 2. Manajemen Kelas (Class Rooms)
- CRUD lengkap untuk data kelas
- Relasi dengan jurusan
- Tingkat kelas (1-6)
- Penghitungan jumlah siswa per kelas
- Proteksi penghapusan jika masih memiliki siswa

### 3. Manajemen Siswa (Students)
- CRUD lengkap untuk data siswa
- Pembuatan akun pengguna otomatis
- Assignment role 'siswa' otomatis
- Password default menggunakan NIS
- Fitur impor dari Excel/CSV
- Fitur ekspor ke Excel
- Relasi dengan kelas dan jurusan

## Instalasi dan Setup

### 1. Install Dependencies
```bash
composer require maatwebsite/excel
composer require spatie/laravel-permission
```

### 2. Publish Config (jika belum)
```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 3. Jalankan Migration
```bash
php artisan migrate
```

### 4. Seed Role 'siswa' (jika belum ada)
```bash
php artisan tinker
```
```php
use Spatie\Permission\Models\Role;
Role::create(['name' => 'siswa']);
```

### 5. Setup Queue (untuk fitur impor background)
```bash
php artisan queue:table
php artisan migrate
```

Jalankan queue worker:
```bash
php artisan queue:work
```

## Struktur File yang Dibuat

### Controllers
- `app/Http/Controllers/MajorController.php`
- `app/Http/Controllers/ClassRoomController.php`
- `app/Http/Controllers/StudentController.php`

### Form Requests
- `app/Http/Requests/StoreMajorRequest.php`
- `app/Http/Requests/UpdateMajorRequest.php`
- `app/Http/Requests/StoreStudentRequest.php`

### Export/Import Classes
- `app/Exports/StudentsExport.php`
- `app/Imports/StudentsImport.php`

### Jobs
- `app/Jobs/ImportStudentsJob.php`

### Views
- `resources/views/livewire/pages/majors/`
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`
- `resources/views/livewire/pages/class-rooms/`
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`
- `resources/views/livewire/pages/students/`
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`

## Routes yang Tersedia

### Admin Routes (Prefix: /admin)
- `GET /admin/majors` - Daftar jurusan
- `GET /admin/majors/create` - Form tambah jurusan
- `POST /admin/majors` - Simpan jurusan baru
- `GET /admin/majors/{id}/edit` - Form edit jurusan
- `PUT /admin/majors/{id}` - Update jurusan
- `DELETE /admin/majors/{id}` - Hapus jurusan

- `GET /admin/class-rooms` - Daftar kelas
- `GET /admin/class-rooms/create` - Form tambah kelas
- `POST /admin/class-rooms` - Simpan kelas baru
- `GET /admin/class-rooms/{id}/edit` - Form edit kelas
- `PUT /admin/class-rooms/{id}` - Update kelas
- `DELETE /admin/class-rooms/{id}` - Hapus kelas

- `GET /admin/students` - Daftar siswa
- `GET /admin/students/create` - Form tambah siswa
- `POST /admin/students` - Simpan siswa baru
- `GET /admin/students/{id}/edit` - Form edit siswa
- `PUT /admin/students/{id}` - Update siswa
- `DELETE /admin/students/{id}` - Hapus siswa
- `GET /admin/students/export` - Ekspor data siswa
- `POST /admin/students/import` - Impor data siswa

## Format File Import Excel

Header yang diperlukan untuk file import:
- `nis` - NIS siswa (wajib)
- `nama` - Nama lengkap siswa (wajib)
- `jenis_kelamin` - L/P atau Laki-laki/Perempuan (wajib)
- `email` - Email siswa (wajib)
- `kelas` - Nama kelas (wajib, harus sudah ada di database)
- `alamat` - Alamat siswa (opsional)
- `no_hp` - Nomor HP siswa (opsional)
- `tahun` - Tahun PKL (opsional, default tahun sekarang)

## Logika Bisnis

### Pembuatan Siswa
1. Validasi data input
2. Membuat akun user dengan:
   - Name: dari nama siswa
   - Email: dari email siswa
   - Password: NIS siswa (di-hash)
   - Email verified: otomatis verified
3. Assign role 'siswa' ke user
4. Membuat record siswa dengan relasi ke user
5. Semua dalam satu transaksi database

### Import Siswa
1. File diupload dan disimpan temporary
2. Job dijalankan di background
3. Setiap baris diproses dengan logika bisnis yang sama
4. Skip baris yang invalid atau duplikat
5. Log error untuk debugging

## Keamanan dan Validasi

### Validasi Data
- Semua input divalidasi menggunakan FormRequest
- NIS dan email harus unique
- Email format valid
- Relasi foreign key divalidasi

### Keamanan
- Semua route dilindungi middleware auth dan role
- CSRF protection untuk semua form
- SQL injection protection dengan Eloquent
- XSS protection dengan Blade templating

## Troubleshooting

### Error: Role 'siswa' not found
Pastikan role 'siswa' sudah dibuat di database:
```php
use Spatie\Permission\Models\Role;
Role::create(['name' => 'siswa']);
```

### Error: Queue not working
Pastikan queue worker berjalan:
```bash
php artisan queue:work
```

### Error: File import failed
- Periksa format header file Excel
- Pastikan kelas yang direferensikan sudah ada
- Periksa log error di `storage/logs/laravel.log`

## Customization

### Menambah Field Baru
1. Tambahkan kolom di migration
2. Update model fillable
3. Update FormRequest validation
4. Update view form
5. Update import/export class

### Mengubah Logika Bisnis
Logika utama berada di:
- `StudentController@store`
- `StudentsImport@createStudent`

## Support

Untuk pertanyaan atau masalah, silakan periksa:
1. Log Laravel di `storage/logs/laravel.log`
2. Log queue di `storage/logs/laravel.log`
3. Dokumentasi Laravel dan package yang digunakan