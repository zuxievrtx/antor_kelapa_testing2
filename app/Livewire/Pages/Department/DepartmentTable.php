<?php

namespace App\Livewire\Pages\Department;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On; 
use App\Models\Department;
    
class DepartmentTable extends DataTableComponent
{
    protected $model = Department::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');

        $this->setBulkActions([
            'deleteSelected' => 'Hapus',
        ]);
        $this->setBulkActionConfirms([ 'deleteSelected']);
        $this->setBulkActionConfirmMessage('deleteSelected', 'Apakah yakin akan menghapus data terpilih?');
        $this->setThAttributes(function(Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'dark:bg-gray-900 py-5 text-end pr-8',
                ];
            }

            return [ 
                'default' => true,
                'class' => 'dark:bg-gray-900 py-5',
            ];
           
        });
    }

    public function builder(): Builder
    {
        $departments =  Department::query();
     
        return $departments;
    }

    #[On('refresh')]
    public function refresh(){
        $this->dispatch('$refresh');
    }

    public function columns(): array
    {
        return [
            Column::make("Kode Departemen", "code")->sortable()
                ->searchable(),
            Column::make("Nama Departemen", "name")->sortable(),
            Column::make("Dibuat", "created_at")
                ->sortable()->deselected()->collapseOnMobile(),
            Column::make("Diedit", "updated_at")
                ->sortable()->deselected()->collapseOnMobile(),
            Column::make("Aksi", "id")
                ->view('livewire.pages.department.department-action')->collapseOnMobile(),
        ];
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        { 
           Department::find($item)->delete();
        }
        $this->clearSelected();
    }
}
