<?php

namespace App\Http\Controllers;

use App\Models\DaftarAtk;
use App\Http\Requests\StoreDaftarAtkRequest;
use App\Http\Requests\UpdateDaftarAtkRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DaftarAtkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('admin/daftaratk/page', [
            'daftarAtk' => DaftarAtk::orderBy('name', 'asc')->get(),
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
    public function store(StoreDaftarAtkRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'category' => 'required|string|max:250',
            'satuan' => 'required|string|max:250',
        ]);

        $validated['kode_unit'] = Auth::user()->pegawai?->unit?->kode_unit;

        DaftarAtk::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'satuan' => $validated['satuan'],
            'kode_unit' => $validated['kode_unit'] ?? null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarAtk $daftarAtk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarAtk $daftarAtk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDaftarAtkRequest $request, DaftarAtk $daftarAtk)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'category' => 'required|string|max:250',
            'satuan' => 'required|string|max:250',
        ]);

        $daftarAtk->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarAtk $daftarAtk)
    {
        $daftarAtk->delete();
    }
}
