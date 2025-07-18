<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CompanyExport implements FromCollection, WithMapping, WithHeadings
{
    private int $counter = 1;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Company::all();
    }

    public function map($company): array
    {
        return [
            $this->counter++,
            $company->name,
            $company->address,
            $company->phone,
            $company->email,
            $company->website,
            $company->leader,

        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Alamat',
            'Kontak',
            'Email',
            'Website',
            'Leader'
        ];
    }
}
