<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Company([
            'name' => $row['nama'],
            'address' => $row['alamat'],
            'phone' => $row['kontak'] ?? null,
            'email' => $row['email'] ?? null,
            'website' => $row['website'] ?? null,
            'leader' => $row['leader'] ?? null,
        ]);
    }
}
