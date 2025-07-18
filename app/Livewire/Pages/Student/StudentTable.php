<?php

namespace App\Livewire\Pages\Student;

use App\Models\Student;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function query()
    {
        return Student::query()->with(['classRoom.major', 'user']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("NIS", "nis")
                ->sortable()
                ->searchable(),
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("Kelas", 'classRoom.name')
                ->sortable()
                ->searchable(),
            Column::make("Jurusan", 'classRoom.major.short_name')
                ->sortable(),
            Column::make("Jenis Kelamin", "gender")
                ->sortable()
                ->format(function($value) {
                    return $value == 'L' ? 'Laki-laki' : 'Perempuan';
                }),
            Column::make("Tahun", "year")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("HP", "hp")
                ->sortable(),
            Column::make('Aksi', 'id')->view('livewire.pages.student.student-action')
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }
}