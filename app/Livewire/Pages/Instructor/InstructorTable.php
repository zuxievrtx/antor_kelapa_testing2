<?php

namespace App\Livewire\Pages\Instructor;

use App\Models\Instructor;
use Livewire\Attributes\On;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class InstructorTable extends DataTableComponent
{

    protected $model = Instructor::class;

    public function query()
    {
        return Instructor::query()->with('company')->with('user');
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Perusahaan", 'company.name')
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable(),
            Column::make("Kontak", "hp")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make('Aksi', 'id')->view('livewire.pages.instructor.instructor-action')
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }
}
