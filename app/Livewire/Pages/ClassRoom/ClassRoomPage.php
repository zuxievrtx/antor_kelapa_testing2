<?php

namespace App\Livewire\Pages\ClassRoom;

use App\Models\ClassRoom;
use App\Models\Major;
use Livewire\Attributes\On;
use Livewire\Component;

class ClassRoomPage extends Component
{
    public $isEdit = false;

    public $id;
    public $major_id;
    public $name;
    public $grade;
    public $idToBeDeleted;

    public function render()
    {
        $majors = Major::all();
        return view('livewire.pages.class-room.class-room-page', compact('majors'))->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'grade' => 'required|integer|min:1|max:3',
        ]);

        $classRoom = $this->isEdit ? ClassRoom::findOrFail($this->id) : new ClassRoom();
        
        $classRoom->major_id = $this->major_id;
        $classRoom->name = $this->name;
        $classRoom->grade = $this->grade;
        $classRoom->save();

        $this->dispatch('refresh')->to(ClassRoomTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');
        $this->resetForm();
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->isEdit = true;
        $classRoom = ClassRoom::findOrFail($id);
        $this->fill([
            'id' => $id,
            'major_id' => $classRoom->major_id,
            'name' => $classRoom->name,
            'grade' => $classRoom->grade,
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
        $classRoom = ClassRoom::findOrFail($this->idToBeDeleted);
        $classRoom->delete();
        $this->dispatch('refresh')->to(ClassRoomTable::class);
        $this->dispatch('show-message', msg: 'Data berhasil dihapus');
    }
}