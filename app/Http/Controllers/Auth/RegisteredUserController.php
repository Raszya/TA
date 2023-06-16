<?php

namespace App\Http\Controllers\Auth;

use App\Models\Guru;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $nis_length = Str::length($request->nis);
        // dd($nis_length);
        if ($nis_length == 16) {
            $request->validate([
                'nis' => ['required', 'string', 'max:16', 'unique:' . User::class . ',nip']
            ]);

            // dd($request);
            $guru = Guru::where('nomer_induk', $request->nis)->first();
            if (!$guru) {
                return redirect()->route('register')->with('Danger', 'Nomer Induk Tidak terdaftar');
            }


            $user = User::create([
                'nip' => $request->nis,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->assignRole('guru');
            // dd($user);
        } elseif ($nis_length == 5) {
            $request->validate([
                'nis' => ['required', 'string', 'max:5', 'unique:' . User::class . ',nis']
            ]);

            $siswa = Siswa::where('nis', $request->nis)->first();

            if (!$siswa) {
                return redirect()->route('register')->with('error', 'Nomer Induk Tidak terdaftar');
            }

            $user = User::create([
                'nis' => $request->nis,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->assignRole('siswa');
        } else {
            return redirect()->route('register')->with('error', 'Register Gagal, Nis/Nip tidak terdaftar');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
