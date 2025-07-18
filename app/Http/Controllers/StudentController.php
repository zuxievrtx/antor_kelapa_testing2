<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Jobs\ImportStudentsJob;
use App\Http\Requests\StoreStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['classRoom.major', 'user'])->get();
        return view('livewire.pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classRooms = ClassRoom::with('major')->get();
        return view('livewire.pages.students.create', compact('classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Create User Account
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->nis), // Use NIS as initial password
                    'email_verified_at' => now(),
                ]);

                // Assign 'siswa' role to user
                $siswaRole = Role::where('name', 'siswa')->first();
                if ($siswaRole) {
                    $user->assignRole($siswaRole);
                }

                // Create Student Record
                Student::create([
                    'user_id' => $user->id,
                    'class_id' => $request->class_id,
                    'nis' => $request->nis,
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'address' => $request->address,
                    'hp' => $request->hp,
                    'year' => $request->year,
                ]);
            });

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil ditambahkan. Akun pengguna telah dibuat dengan password default: NIS siswa.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['classRoom.major', 'user']);
        return view('livewire.pages.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classRooms = ClassRoom::with('major')->get();
        return view('livewire.pages.students.edit', compact('student', 'classRooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|unique:students,email,' . $student->id . '|unique:users,email,' . $student->user_id,
            'address' => 'nullable|string',
            'hp' => 'nullable|string|max:20',
            'year' => 'required|integer|min:2020|max:2030',
        ]);

        try {
            DB::transaction(function () use ($request, $student) {
                // Update User Account
                $student->user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                // Update Student Record
                $student->update([
                    'class_id' => $request->class_id,
                    'nis' => $request->nis,
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'address' => $request->address,
                    'hp' => $request->hp,
                    'year' => $request->year,
                ]);
            });

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            DB::transaction(function () use ($student) {
                // Delete the associated user account
                $student->user->delete();
                
                // Delete the student record
                $student->delete();
            });

            return redirect()->route('students.index')
                ->with('success', 'Siswa dan akun pengguna berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Export students to Excel
     */
    public function export()
    {
        return Excel::download(new StudentsExport, 'students-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Import students from Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Max 10MB
        ]);

        try {
            // Dispatch job to handle import in background
            ImportStudentsJob::dispatch($request->file('file'));

            return redirect()->route('students.index')
                ->with('success', 'File berhasil diunggah. Proses impor sedang berjalan di background.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}