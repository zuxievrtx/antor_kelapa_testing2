<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::withCount('classRooms')->get();
        return view('livewire.pages.majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livewire.pages.majors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Major::create([
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                ]);
            });

            return redirect()->route('majors.index')
                ->with('success', 'Jurusan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        $major->load('classRooms');
        return view('livewire.pages.majors.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        return view('livewire.pages.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        try {
            DB::transaction(function () use ($request, $major) {
                $major->update([
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                ]);
            });

            return redirect()->route('majors.index')
                ->with('success', 'Jurusan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        try {
            // Check if major has associated class rooms
            if ($major->classRooms()->count() > 0) {
                return redirect()->route('majors.index')
                    ->with('error', 'Jurusan tidak dapat dihapus karena masih memiliki kelas.');
            }

            DB::transaction(function () use ($major) {
                $major->delete();
            });

            return redirect()->route('majors.index')
                ->with('success', 'Jurusan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}