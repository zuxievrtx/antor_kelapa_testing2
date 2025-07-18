<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::with(['classRoom.major'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NIS',
            'Nama',
            'Jenis Kelamin',
            'Email',
            'Kelas',
            'Jurusan',
            'Tahun',
            'Alamat',
            'No. HP',
        ];
    }

    /**
     * @param Student $student
     * @return array
     */
    public function map($student): array
    {
        return [
            $student->nis,
            $student->name,
            $student->gender === 'L' ? 'Laki-laki' : 'Perempuan',
            $student->email,
            $student->classRoom->name,
            $student->classRoom->major->name,
            $student->year,
            $student->address,
            $student->hp,
        ];
    }
}