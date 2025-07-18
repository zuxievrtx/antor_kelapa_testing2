<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Cari kelas berdasarkan nama
            $classRoom = ClassRoom::where('name', $row['kelas'])->first();
            if (!$classRoom) {
                continue; // Skip jika kelas tidak ditemukan
            }

            // Cek apakah student sudah ada berdasarkan NIS
            $existingStudent = Student::where('nis', $row['nis'])->first();
            
            if (!$existingStudent) {
                // Buat user baru
                $user = new User();
                $user->name = $row['nama'];
                $user->email = $row['nis'] . '@belajar.id';
                $user->password = Hash::make($row['nis']); // Password menggunakan NIS
                $user->save();
                
                // Assign role siswa
                $user->assignRole('siswa');

                // Buat student baru
                $student = new Student();
                $student->user_id = $user->id;
                $student->class_id = $classRoom->id;
                $student->nis = $row['nis'];
                $student->name = $row['nama'];
                $student->gender = $row['jenis_kelamin'];
                $student->email = $row['nis'] . '@belajar.id';
                $student->address = $row['alamat'] ?? null;
                $student->hp = $row['hp'] ?? null;
                $student->year = $row['tahun'] ?? date('Y');
                $student->save();
            } else {
                // Update student yang sudah ada
                $existingStudent->class_id = $classRoom->id;
                $existingStudent->name = $row['nama'];
                $existingStudent->gender = $row['jenis_kelamin'];
                $existingStudent->address = $row['alamat'] ?? null;
                $existingStudent->hp = $row['hp'] ?? null;
                $existingStudent->year = $row['tahun'] ?? date('Y');
                $existingStudent->save();

                // Update user terkait
                $existingStudent->user->name = $row['nama'];
                $existingStudent->user->save();
            }
        }
    }
}