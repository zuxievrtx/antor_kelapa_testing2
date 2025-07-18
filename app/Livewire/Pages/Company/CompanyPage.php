<?php

namespace App\Livewire\Pages\Company;

use App\Exports\CompanyExport;
use App\Imports\CompanyImport;
use App\Models\Company;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CompanyPage extends Component
{
    use WithFileUploads;

    public $isEdit = false;

    public $id;
    public $name;
    public $address;
    public $phone;
    public $email;
    public $website;
    public $leader;
    public $file;

    public $idToBeDeleted;


    public function render()
    {
        return view('livewire.pages.company.company-page')->layout('layouts.app');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'nullable',
            'email' => [
                'nullable',
                'email',
                Rule::unique('companies', 'email')->ignore($this->isEdit ? $this->id : null),
            ],
            'website' => 'nullable|url',
            'leader' => 'nullable|string',
        ]);

        $company = $this->isEdit ? Company::findOrFail($this->id) : new Company();

        $company->id = $this->id;
        $company->name = $this->name;
        $company->address = $this->address;
        $company->phone = $this->phone;
        $company->email = $this->email;
        $company->website = $this->website;
        $company->leader = $this->leader;

        $company->save();

        $this->dispatch('refresh')->to(CompanyTable::class);
        $this->dispatch('close-modal');
        $this->dispatch('show-message', msg: 'Data berhasil disimpan');
        $this->resetForm();
    }

    #[On('edit')]
    public function edit(int|string $id)
    {
        $this->isEdit = true;
        $company = Company::findOrFail($id);
        $this->fill([
            'id' => $id,
            'name' => $company->name,
            'address' => $company->address,
            'phone' => $company->phone,
            'email' => $company->email,
            'website' => $company->website,
            'leader' => $company->leader,
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
        $c = Company::findOrFail($this->idToBeDeleted);
        $c->delete();
        $this->dispatch('refresh')->to(CompanyTable::class);
        $this->dispatch('show-message', msg: 'Data berhasil dihapus');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required'
        ]);

        Excel::import(new CompanyImport, $this->file);

        $this->dispatch('refresh')->to(CompanyTable::class);
        $this->dispatch('close-import');
        $this->dispatch('show-message', msg: 'Data Berhasil di Import!');
        $this->resetForm();
    }

    public function exportToXLSX()
    {
        return Excel::download(new CompanyExport, 'companies.xlsx');
    }

    public function exportToPDF()
    {
        $companies = Company::all();
        $pdf = Pdf::loadView('livewire.pages.company.company-pdf', compact('companies'));
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'companies.pdf');
    }
}
