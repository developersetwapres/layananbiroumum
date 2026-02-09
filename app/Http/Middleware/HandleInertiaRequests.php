<?php

namespace App\Http\Middleware;

use App\Models\DaftarAtk;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        if (Auth::check()) {
            $user = Auth::user()->load('pegawai.biro');
            // $permissions = $user->getAllPermissions()->pluck('name')->toArray();
            $permissions = [];
        } else {
            $user = null;
            $permissions = [];
        }

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',

            'notifFromServer' => Notification::latest()->get(),


            'flash' => [
                'message'  => fn() => $request->session()->get('message'),
                'availableRoom' => fn() => $request->session()->get('availableRoom'),
            ],

            'kategoriAtk' => DaftarAtk::select('category')->distinct()->pluck('category'),

            'auth' => [
                'user' => $user ? [
                    'nip' => $user->pegawai->nip ?? null,
                    'name' => $user->pegawai->name ?? null,
                    'email' => $user->email ?? null,
                    'unit' => $user->pegawai?->unit ? [
                        'kode_unit' => $user->pegawai?->unit->kode_unit,
                        'nama_unit' => $user->pegawai?->unit->nama_unit,
                    ] : null,
                    'biro' => $user->pegawai?->biro ? [
                        'kode_biro' => $user->pegawai?->biro->kode_biro,
                        'nama_biro' => $user->pegawai?->biro->nama_biro,
                    ] : null,
                ] : null,
                'permissions' => $permissions,
            ],

        ];
    }
}
