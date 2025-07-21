# Dokumentasi CRUD Data Siswa - Laravel Livewire

## Overview
Implementasi CRUD (Create, Read, Update, Delete) untuk data siswa dengan fitur import/export Excel sesuai spesifikasi Paket Pekerjaan 1.

## Fitur yang Sudah Diimplementasikan

### 1. CRUD Data Jurusan (Majors)
- **Model**: `App\Models\Major`
- **Livewire Components**:
  - `App\Livewire\Pages\Major\MajorPage` - Halaman utama dengan form modal
  - `App\Livewire\Pages\Major\MajorTable` - Tabel data dengan fitur pencarian dan sorting
- **Views**:
  - `resources/views/livewire/pages/major/major-page.blade.php`
  - `resources/views/livewire/pages/major/major-action.blade.php`
- **Route**: `/admin/jurusan`
- **Fields**:
  - `name` - Nama jurusan (contoh: Rekayasa Perangkat Lunak)
  - `short_name` - Singkatan (contoh: RPL, TKJ)

### 2. CRUD Data Kelas (ClassRooms)
- **Model**: `App\Models\ClassRoom`
- **Livewire Components**:
  - `App\Livewire\Pages\ClassRoom\ClassRoomPage` - Halaman utama dengan form modal
  - `App\Livewire\Pages\ClassRoom\ClassRoomTable` - Tabel data dengan relasi ke jurusan
- **Views**:
  - `resources/views/livewire/pages/class-room/class-room-page.blade.php`
  - `resources/views/livewire/pages/class-room/class-room-action.blade.php`
- **Route**: `/admin/kelas`
- **Fields**:
  - `major_id` - Foreign key ke tabel majors
  - `name` - Nama kelas (contoh: A, B, C)
  - `grade` - Tingkat kelas (1, 2, 3)

### 3. CRUD Data Siswa (Students)
- **Model**: `App\Models\Student`
- **Livewire Components**:
  - `App\Livewire\Pages\Student\StudentPage` - Halaman utama dengan form modal dan fitur import/export
  - `App\Livewire\Pages\Student\StudentTable` - Tabel data dengan relasi ke kelas dan jurusan
- **Views**:
  - `resources/views/livewire/pages/student/student-page.blade.php`
  - `resources/views/livewire/pages/student/student-action.blade.php`
  - `resources/views/livewire/pages/student/student-excel.blade.php` - Template export
  - `resources/views/livewire/pages/student/student-format.blade.php` - Template format import
- **Route**: `/admin/siswa`
- **Fields**:
  - `user_id` - Foreign key ke tabel users (dibuat otomatis)
  - `class_id` - Foreign key ke tabel class_rooms
  - `nis` - Nomor Induk Siswa (unique)
  - `name` - Nama siswa
  - `gender` - Jenis kelamin (L/P)
  - `email` - Email siswa (format: nis@belajar.id)
  - `address` - Alamat (nullable)
  - `hp` - Nomor HP (nullable)
  - `year` - Tahun PKL

## Fitur Khusus Data Siswa

### 1. Pembuatan User Otomatis
- Ketika menambah/import data siswa, sistem otomatis membuat user dengan:
  - **Email**: `{nis}@belajar.id`
  - **Password**: `{nis}` (menggunakan NIS sebagai password)
  - **Role**: `siswa`

### 2. Export Data
- **File**: `App\Exports\StudentExport`
- **Format**: Excel (.xlsx)
- **Nama File**: `data-siswa.xlsx`
- **Kolom**: NIS, Nama, Kelas, Jurusan, Tingkat, Jenis Kelamin, Email, Alamat, No. HP, Tahun PKL

### 3. Import Data
- **File**: `App\Imports\StudentImport`
- **Format**: Excel (.xlsx, .xls) atau CSV
- **Kolom yang Diperlukan**:
  - `nis` - Nomor Induk Siswa
  - `nama` - Nama siswa
  - `kelas` - Nama kelas (harus sesuai dengan data di tabel class_rooms)
  - `jenis_kelamin` - L atau P
  - `alamat` - Alamat (optional)
  - `hp` - Nomor HP (optional)
  - `tahun` - Tahun PKL

### 4. Download Format Template
- **File**: `App\Exports\StudentFormat`
- **Nama File**: `format-siswa.xlsx`
- **Isi**: Template kosong dengan contoh data dan daftar kelas yang tersedia

## Validasi

### Major
- `name`: required, string, max 255 karakter
- `short_name`: required, string, max 10 karakter, unique

### ClassRoom
- `major_id`: required, exists di tabel majors
- `name`: required, string, max 255 karakter
- `grade`: required, integer, min 1, max 3

### Student
- `class_id`: required, exists di tabel class_rooms
- `nis`: required, string, unique
- `name`: required, string, max 255 karakter
- `gender`: required, in L,P
- `year`: required, integer, min 2020, max (tahun sekarang + 5)

## Akses dan Permissions
- Semua halaman hanya dapat diakses oleh user dengan role `superadmin`
- Route prefix: `/admin/`

## Cara Menggunakan

### 1. Menambah Data Jurusan
1. Akses `/admin/jurusan`
2. Klik "Tambah Jurusan"
3. Isi form dan simpan

### 2. Menambah Data Kelas
1. Akses `/admin/kelas`
2. Klik "Tambah Kelas"
3. Pilih jurusan, isi nama kelas dan tingkat
4. Simpan

### 3. Menambah Data Siswa
1. Akses `/admin/siswa`
2. Klik "Tambah Siswa"
3. Isi form lengkap
4. Simpan (sistem otomatis membuat user)

### 4. Import Data Siswa
1. Akses `/admin/siswa`
2. Klik "Download Format" untuk mendapatkan template
3. Isi template dengan data siswa
4. Klik "Import Data"
5. Upload file Excel
6. Sistem akan memproses dan membuat user otomatis

### 5. Export Data Siswa
1. Akses `/admin/siswa`
2. Klik "Export Data"
3. File Excel akan terdownload otomatis

## Struktur Database

### Tabel majors
```sql
- id (primary key)
- name (varchar)
- short_name (varchar, unique)
- created_at
- updated_at
```

### Tabel class_rooms
```sql
- id (primary key)
- major_id (foreign key)
- name (varchar)
- grade (integer)
- created_at
- updated_at
```

### Tabel students
```sql
- id (primary key)
- user_id (foreign key)
- class_id (foreign key)
- nis (varchar, unique)
- name (varchar)
- gender (enum: L, P)
- email (varchar, unique)
- address (text, nullable)
- hp (varchar, nullable)
- year (year)
- created_at
- updated_at
```

## Dependencies yang Diperlukan
- Laravel Livewire
- Laravel Livewire Tables (Rappasoft)
- Laravel Excel (Maatwebsite)
- Spatie Laravel Permission

## Catatan Penting
1. Pastikan role `siswa` sudah dibuat di sistem
2. Pastikan komponen UI (x-modal, x-button-primary, dll) sudah tersedia
3. Sistem menggunakan email format `{nis}@belajar.id` untuk siswa
4. Password default siswa adalah NIS mereka
5. Import akan skip baris jika kelas tidak ditemukan
6. Import akan update data jika NIS sudah ada