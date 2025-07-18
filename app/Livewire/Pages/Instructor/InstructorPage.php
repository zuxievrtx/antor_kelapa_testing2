<?php

namespace App\Livewire\Pages\Instructor;

use App\Models\Company;
use App\Models\Instructor;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class InstructorPage extends Component
{
    public $isEdit = false;

    public $id;
    public $company_id;
    public $user_id;
    public $name;
    public $hp;
    public $email;
    public $idToBeDeleted;


    public function render()
    {
        $companies = Company::all();
        return view('livewire.pages.instructor.instructor-page', compact('companies'))->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required',
            'hp' => 'required',
            'email' => 'required|email',
        ]);

        $instructor = $this->isEdit ? Instructor::findOrFail($this->id) : new Instructor();
        if (!$this->isEdit) {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = $this->hp;

            $user->save();

            $this->user_id = $user->id;
            $user->assignRole('dudi');
        }

        $instructor->company_id = $this->company_id;
        $instructor->user_id = $this->user_id;
        $instructor->name = $this->name;
        $instructor->email = $this->email;
        $instructor->hp = $this->hp;
        $instructor->save();


        $this->dispatch('refresh')->to(InstructorTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');
        $this->resetForm();
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->isEdit = true;
        $instructor = Instructor::findOrFail($id);
        $this->fill([
            'id' => $id,
            'company_id' => $instructor->company_id,
            'user_id' => $instructor->user_id,
            'name' => $instructor->name,
            'email' => $instructor->email,
            'hp' => $instructor->hp,
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
        $c = Instructor::findOrFail($this->idToBeDeleted);
        $c->user->delete();
        $c->delete();
        $this->dispatch('refresh')->to(InstructorTable::class);
        $this->dispatch('show-message', msg: 'Data berhasil dihapus');
    }
}
