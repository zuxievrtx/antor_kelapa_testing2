<?php

namespace App\Livewire\Pages\Major;

use App\Models\Major;
use Livewire\Attributes\On;
use Livewire\Component;

class MajorPage extends Component
{
    public $isEdit = false;

    public $id;
    public $name;
    public $short_name;
    public $idToBeDeleted;

    public function render()
    {
        return view('livewire.pages.major.major-page')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:10|unique:majors,short_name,' . ($this->isEdit ? $this->id : 'NULL'),
        ]);

        $major = $this->isEdit ? Major::findOrFail($this->id) : new Major();
        
        $major->name = $this->name;
        $major->short_name = $this->short_name;
        $major->save();

        $this->dispatch('refresh')->to(MajorTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');
        $this->resetForm();
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->isEdit = true;
        $major = Major::findOrFail($id);
        $this->fill([
            'id' => $id,
            'name' => $major->name,
            'short_name' => $major->short_name,
        ]);
        $this->dispatch('open-modal');
    }

    #[On('confirm')]
    public function confirm($id)
    {
        $this->idToBeDeleted = $id;
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function delete()
    {
        $major = Major::findOrFail($this->idToBeDeleted);
        $major->delete();
        $this->dispatch('refresh')->to(MajorTable::class);
        $this->dispatch('show-message', msg: 'Data berhasil dihapus');
    }
}