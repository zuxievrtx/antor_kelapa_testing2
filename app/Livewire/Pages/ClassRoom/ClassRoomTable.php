<?php

namespace App\Livewire\Pages\ClassRoom;

use App\Models\ClassRoom;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClassRoomTable extends DataTableComponent
{
    protected $model = ClassRoom::class;

    public function query()
    {
        return ClassRoom::query()->with('major');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Jurusan", 'major.name')
                ->sortable()
                ->searchable(),
            Column::make("Nama Kelas", "name")
                ->sortable()
                ->searchable(),
            Column::make("Tingkat", "grade")
                ->sortable(),
            Column::make('Aksi', 'id')->view('livewire.pages.class-room.class-room-action')
        ];
    }

    #[On('refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }
}