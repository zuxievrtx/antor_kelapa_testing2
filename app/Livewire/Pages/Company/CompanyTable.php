<?php

namespace App\Livewire\Pages\Company;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Company;
use Livewire\Attributes\On;

class CompanyTable extends DataTableComponent
{
    protected $model = Company::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", 'name')
                ->sortable(),
            Column::make("Alamat", "address")
                ->sortable(),
            Column::make("Kontak", "phone")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Website", "website")
                ->sortable(),
            Column::make("Pemimpin", "leader")
                ->sortable(),
            Column::make('Aksi', 'id')->view('livewire.pages.company.company-action')
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }
}
