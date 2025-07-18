<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->createStudent($row);
        }
    }

    private function createStudent($row)
    {
        // Validate required fields
        if (empty($row['nis']) || empty($row['nama']) || empty($row['email']) || empty($row['kelas'])) {
            return; // Skip invalid rows
        }

        // Find class room by name
        $classRoom = ClassRoom::where('name', $row['kelas'])->first();
        if (!$classRoom) {
            return; // Skip if class room not found
        }

        // Check if student already exists
        if (Student::where('nis', $row['nis'])->exists() || 
            Student::where('email', $row['email'])->exists() ||
            User::where('email', $row['email'])->exists()) {
            return; // Skip if student already exists
        }

        try {
            DB::transaction(function () use ($row, $classRoom) {
                // Create User Account
                $user = User::create([
                    'name' => $row['nama'],
                    'email' => $row['email'],
                    'password' => Hash::make($row['nis']), // Use NIS as initial password
                    'email_verified_at' => now(),
                ]);

                // Assign 'siswa' role to user
                $siswaRole = Role::where('name', 'siswa')->first();
                if ($siswaRole) {
                    $user->assignRole($siswaRole);
                }

                // Create Student Record
                Student::create([
                    'user_id' => $user->id,
                    'class_id' => $classRoom->id,
                    'nis' => $row['nis'],
                    'name' => $row['nama'],
                    'gender' => $this->parseGender($row['jenis_kelamin'] ?? 'L'),
                    'email' => $row['email'],
                    'address' => $row['alamat'] ?? null,
                    'hp' => $row['no_hp'] ?? null,
                    'year' => $row['tahun'] ?? date('Y'),
                ]);
            });
        } catch (\Exception $e) {
            // Log error or handle as needed
            \Log::error('Failed to import student: ' . $e->getMessage(), [
                'row' => $row->toArray()
            ]);
        }
    }

    private function parseGender($gender)
    {
        $gender = strtolower($gender);
        if (in_array($gender, ['l', 'laki-laki', 'male', 'pria'])) {
            return 'L';
        } elseif (in_array($gender, ['p', 'perempuan', 'female', 'wanita'])) {
            return 'P';
        }
        return 'L'; // Default to male
    }
}