<?php

namespace App\Livewire\Pages\Major;

use App\Models\Major;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MajorTable extends DataTableComponent
{
    protected $model = Major::class;

    public function query()
    {
        return Major::query();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nama Jurusan", "name")
                ->sortable()
                ->searchable(),
            Column::make("Singkatan", "short_name")
                ->sortable()
                ->searchable(),
            Column::make('Aksi', 'id')->view('livewire.pages.major.major-action')
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }
}