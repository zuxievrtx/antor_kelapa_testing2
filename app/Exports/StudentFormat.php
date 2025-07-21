<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\ClassRoom;

class StudentFormat implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('livewire.pages.student.student-format', [
            'classRooms' => ClassRoom::with('major')->get()
        ]);
    }
}