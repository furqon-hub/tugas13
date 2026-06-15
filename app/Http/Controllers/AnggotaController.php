<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Anggota;
 
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::latest()->get();
        
        // Statistik
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();
        
        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }
 
    // Methods lainnya akan diimplementasi di pertemuan 13
    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_anggota' => 'required|unique:anggota|max:255',
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:anggota|max:255',
            'telepon' => 'required|max:20',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|max:255',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        Anggota::create($validatedData);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(string $id) { }
    public function update(Request $request, string $id) { }
    public function destroy(string $id) { }
}