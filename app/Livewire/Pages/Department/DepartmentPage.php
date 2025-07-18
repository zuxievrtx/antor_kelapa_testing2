<?php

namespace App\Livewire\Pages\Department;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Department;

class DepartmentPage extends Component
{
    public $idDelete;
    public $isEdit = false;

    //Data untuk form    
    public $id;   
    public $code; 
    public $name;

    public function render()
    {
        return view('livewire.pages.department.department-page')->layout('layouts.app');
    }

    //Mengambil data edit ketika tombol edit diklik
    #[On('edit')]
    public function edit($id){
        $department = Department::find($id);
        $this->isEdit = true;
        $this->fill([
            "id" => $department->id,
            "code" => $department->code,
            "name" => $department->name,
        ]);
        $this->dispatch('open-modal');
    }

    //Menyimpan data form input/edit
    public function save(){
        //Menerapkan validasi data
        $this->validate([
            'code' => 'required|unique:departments,code,'.$this->id,
            'name'  => 'required',
        ]);

        //Menyimpan data sesuai dengan status form (input/edit)
         if($this->isEdit) $department = Department::find($this->id);
         else $department = new Department;
                     
            $department->code    = $this->code;
            $department->name     = $this->name;

         if($this->isEdit) $department->update();
         else $department->save();
        
         $this->isEdit = false;   
         //Merefresh tabel, menutup modal, menampilkan alert dan mereset form
         $this->dispatch('refresh')->to(DepartmentTable::class);
         $this->dispatch('close-modal');
         $this->dispatch('show-message', msg:'Data berhasil disimpan');   
         $this->resetForm();
    }

    //Menyimpan id yang akan dihapus
    #[On('confirm')]
    public function confirm($id){
        $this->idDelete = $id;
    }
    
    //Menghapus data sesuai id tersimpan
    public function delete()
    {
        $department = Department::find($this->idDelete);
        if($department){
            $department->delete();        
            $this->dispatch('refresh')->to(DepartmentTable::class);
            $this->dispatch('show-message', msg:'Data berhasil dihapus');
        }
    }

    //Mereset form
    public function resetForm(){        
        $this->resetValidation();
        $this->reset();
    }

    
}
