<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classRooms = ClassRoom::with(['major'])->withCount('students')->get();
        return view('livewire.pages.class-rooms.index', compact('classRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = Major::all();
        return view('livewire.pages.class-rooms.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'grade' => 'required|integer|min:1|max:6',
        ]);

        try {
            DB::transaction(function () use ($request) {
                ClassRoom::create([
                    'major_id' => $request->major_id,
                    'name' => $request->name,
                    'grade' => $request->grade,
                ]);
            });

            return redirect()->route('class-rooms.index')
                ->with('success', 'Kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        $classRoom->load(['major', 'students']);
        return view('livewire.pages.class-rooms.show', compact('classRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        $majors = Major::all();
        return view('livewire.pages.class-rooms.edit', compact('classRoom', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'name' => 'required|string|max:255',
            'grade' => 'required|integer|min:1|max:6',
        ]);

        try {
            DB::transaction(function () use ($request, $classRoom) {
                $classRoom->update([
                    'major_id' => $request->major_id,
                    'name' => $request->name,
                    'grade' => $request->grade,
                ]);
            });

            return redirect()->route('class-rooms.index')
                ->with('success', 'Kelas berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        try {
            // Check if class room has associated students
            if ($classRoom->students()->count() > 0) {
                return redirect()->route('class-rooms.index')
                    ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
            }

            DB::transaction(function () use ($classRoom) {
                $classRoom->delete();
            });

            return redirect()->route('class-rooms.index')
                ->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}