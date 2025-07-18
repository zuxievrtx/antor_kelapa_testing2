<?php

namespace App\Livewire\Pages\Student;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\User;
use App\Exports\StudentExport;
use App\Exports\StudentFormat;
use App\Imports\StudentImport;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class StudentPage extends Component
{
    use WithFileUploads;

    public $isEdit = false;

    public $id;
    public $user_id;
    public $class_id;
    public $nis;
    public $name;
    public $gender;
    public $email;
    public $address;
    public $hp;
    public $year;
    public $idToBeDeleted;

    public $file;
    public $showImport = false;

    public function render()
    {
        $classRooms = ClassRoom::with('major')->get();
        return view('livewire.pages.student.student-page', compact('classRooms'))->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'nis' => 'required|string|unique:students,nis,' . ($this->isEdit ? $this->id : 'NULL'),
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'year' => 'required|integer|min:2020|max:' . (date('Y') + 5),
        ]);

        $student = $this->isEdit ? Student::findOrFail($this->id) : new Student();
        
        if (!$this->isEdit) {
            // Buat user baru untuk siswa
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->nis . '@belajar.id';
            $user->password = Hash::make($this->nis);
            $user->save();
            
            // Assign role siswa
            $user->assignRole('siswa');
            
            $this->user_id = $user->id;
            $this->email = $user->email;
        }

        $student->user_id = $this->user_id;
        $student->class_id = $this->class_id;
        $student->nis = $this->nis;
        $student->name = $this->name;
        $student->gender = $this->gender;
        $student->email = $this->email;
        $student->address = $this->address;
        $student->hp = $this->hp;
        $student->year = $this->year;
        $student->save();

        // Update user jika edit
        if ($this->isEdit) {
            $student->user->name = $this->name;
            $student->user->save();
        }

        $this->dispatch('refresh')->to(StudentTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');
        $this->resetForm();
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->isEdit = true;
        $student = Student::findOrFail($id);
        $this->fill([
            'id' => $id,
            'user_id' => $student->user_id,
            'class_id' => $student->class_id,
            'nis' => $student->nis,
            'name' => $student->name,
            'gender' => $student->gender,
            'email' => $student->email,
            'address' => $student->address,
            'hp' => $student->hp,
            'year' => $student->year,
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
        $student = Student::findOrFail($this->idToBeDeleted);
        $student->user->delete();
        $student->delete();
        $this->dispatch('refresh')->to(StudentTable::class);
        $this->dispatch('show-message', msg: 'Data berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'data-siswa.xlsx');
    }

    public function downloadFormat()
    {
        return Excel::download(new StudentFormat, 'format-siswa.xlsx');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new StudentImport, $this->file);
            $this->dispatch('refresh')->to(StudentTable::class);
            $this->dispatch('show-message', msg: 'Data berhasil diimpor');
            $this->file = null;
            $this->showImport = false;
        } catch (\Exception $e) {
            $this->dispatch('show-message', msg: 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}