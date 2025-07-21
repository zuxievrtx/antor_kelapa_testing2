<?php

use App\Livewire\Pages\Company\CompanyPage;
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\DashboardPage;
use App\Livewire\Pages\SettingPage;

use App\Livewire\Pages\User\UserProfile;
use App\Livewire\Pages\User\UserPage;

use App\Livewire\Pages\Worker\WorkerPage;
use App\Livewire\Pages\Department\DepartmentPage;
use App\Livewire\Pages\Instructor\InstructorPage;
use App\Livewire\Pages\Major\MajorPage;
use App\Livewire\Pages\ClassRoom\ClassRoomPage;
use App\Livewire\Pages\Student\StudentPage;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', DashboardPage::class)->name('home');
    Route::get('/dashboard', DashboardPage::class)->name('dashboard');
    Route::get('/profil', UserProfile::class)->name('profile');
    Route::get('/logo', SettingPage::class)->name('logo');
});


Route::middleware(['auth', 'role:superadmin'])->prefix('/admin')->group(function () {
    Route::get('/user', UserPage::class)->name('user');
    Route::get('/pekerja', WorkerPage::class)->name('worker');
    Route::get('/departemen', DepartmentPage::class)->name('department');
    Route::get('/dudi', CompanyPage::class)->name('company');
    Route::get('/instruktur', InstructorPage::class)->name('instructor');
    Route::get('/jurusan', MajorPage::class)->name('major');
    Route::get('/kelas', ClassRoomPage::class)->name('classroom');
    Route::get('/siswa', StudentPage::class)->name('student');
});


Route::middleware(['auth', 'role:kepsek'])->prefix('/kepsek')->group(function () {
    //
});

Route::middleware(['auth', 'role:wakahumas'])->prefix('/wakahumas')->group(function () {
    //
});

Route::middleware(['auth', 'role:pokja'])->prefix('/pokja')->group(function () {
    //
});

Route::middleware(['auth', 'role:guru'])->prefix('/guru')->group(function () {
    //
});


Route::middleware(['auth', 'role:dudi'])->prefix('/dudi')->group(function () {
    //
});


Route::middleware(['auth', 'role:siswa'])->prefix('/siswa')->group(function () {
    //
});

require __DIR__ . '/auth.php';
