<?php

namespace App\Http\Controllers;

use App\Models\DaftarRuangan;
use App\Http\Requests\StoreDaftarRuanganRequest;
use App\Http\Requests\UpdateDaftarRuanganRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class DaftarRuanganController extends Controller
{
    protected $ruangans;

    public function __construct()
    {
        $this->ruangans = DaftarRuangan::latest()->paginate(15);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('admin/rooms/page', [
            'ruangans' => $this->ruangans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDaftarRuanganRequest $request)
    {
        $path = $request->photo->store('images/rooms', 'public');

        DaftarRuangan::create([
            'kode_unit' => Auth::user()->pegawai?->unit?->kode_unit,
            'nama_ruangan' => $request->nama_ruangan,
            'kode_ruangan' => $request->kode_ruangan,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'image' => $path,
            'status' => $request->status,
            'fasilitas' => $request->fasilitas,
        ]);

        return to_route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarRuangan $daftarRuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarRuangan $daftarRuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDaftarRuanganRequest $request, DaftarRuangan $daftarRuangan)
    {
        if ($request->hasFile('photo')) {
            // Hapus file lama
            if ($daftarRuangan->image && Storage::disk('public')->exists($daftarRuangan->image)) {
                Storage::disk('public')->delete($daftarRuangan->image);
            }

            $path = $request->file('photo')->store('images/rooms', 'public');
        } else {
            $path = $daftarRuangan->image;
        }

        $daftarRuangan->update([
            'nama_ruangan' => $request->input('nama_ruangan'),
            'lokasi' => $request->input('lokasi'),
            'kapasitas' => $request->input('kapasitas'),
            'kapasitas_max' => $request->input('kapasitas_max'),
            'image' => $path,
            'status' => $request->input('status'),
            'fasilitas' => $request->input('fasilitas'),
        ]);

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarRuangan $daftarRuangan)
    {
        if ($daftarRuangan->image && Storage::disk('public')->exists($daftarRuangan->image)) {
            Storage::disk('public')->delete($daftarRuangan->image);
        }

        // Hapus data daftarRuangan
        $daftarRuangan->delete();

        return to_route('rooms.index');
    }
}
