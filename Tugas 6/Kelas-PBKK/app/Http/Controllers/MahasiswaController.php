<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nrp', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
    
        $mahasiswas = $query->paginate(10);
    
        return Inertia::render('Mahasiswa/index', [
            'mahasiswas' => $mahasiswas,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Mahasiswa/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nrp' => 'required|string|max:12|unique:mahasiswas',
            'email' => 'required|string|email|max:50|unique:mahasiswas',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return Inertia::render('Mahasiswa/Edit', ['mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nrp' => 'required|string|max:12|unique:mahasiswas,nrp,' . $mahasiswa->id,
            'email' => 'required|string|email|max:50|unique:mahasiswas,email,' . $mahasiswa->id,
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa deleted successfully.');
    }
}




