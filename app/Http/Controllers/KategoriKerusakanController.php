<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerusakan;
use App\Http\Requests\StoreKategoriKerusakanRequest;
use App\Http\Requests\UpdateKategoriKerusakanRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class KategoriKerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('admin/kategorikerusakan/page', [
            'kategoriKerusakan' => KategoriKerusakan::latest()->get(),
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
    public function store(StoreKategoriKerusakanRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'kode_kerusakan' => 'required|string|max:50|unique:kategori_kerusakans,kode_kerusakan',
            'sub_kategori' => 'nullable|array',
            'sub_kategori.*' => 'nullable|string|max:250',
        ]);

        $validated['kode_unit'] = Auth::user()->pegawai?->unit?->kode_unit;

        KategoriKerusakan::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKerusakan $kategoriKerusakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKerusakan $kategoriKerusakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriKerusakanRequest $request, KategoriKerusakan $kategoriKerusakan)
    {
        $kategoriKerusakan->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKerusakan $kategoriKerusakan)
    {
        $kategoriKerusakan->delete();
    }
}
