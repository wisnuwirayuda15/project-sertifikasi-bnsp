<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Agama;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    $agama = Agama::all();
    return view('auth.register', compact('agama'));
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $data = $request->validate([
      'nama_lengkap' => ['required', 'string', 'max:255'],
      'foto' => ['required', 'image', 'file', 'max:2000'],
      'alamat_ktp' => ['required', 'string', 'max:255'],
      'alamat_saat_ini' => ['required', 'string', 'max:255'],
      'kecamatan' => ['required', 'string', 'max:255'],
      'kabupaten' => ['required', 'string', 'max:255'],
      'provinsi' => ['required', 'string', 'max:255'],
      'telepon' => ['required', 'numeric', 'min:10'],
      'hp' => ['required', 'numeric', 'min:10', Rule::unique('users')],
      'kewarganegaraan' => ['required', 'string', 'in:WNI Asli,WNI Keturunan,WNA'],
      'wna' => ['string', 'max:255'],
      'tgl_lahir' => ['required', 'date'],
      'kota_lahir' => ['required', 'string', 'max:255'],
      'provinsi_lahir' => ['required', 'string', 'max:255'],
      'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
      'status_menikah' => ['required', 'in:Belum Menikah,Menikah,Lain-lain'],
      'agama_id' => ['required', Rule::in(Agama::pluck('id')->all())],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    if ($request->foto) {
      $foto = fake()->uuid() . '.' . $data['foto']->extension();
      $request->file('foto')->move(public_path('/img/foto'), $foto);
      $data['foto'] = "/img/foto/$foto";
    }

    if ($request->wna) {
      $data['kewarganegaraan'] = $request->wna;
    }

    $url = 'https://www.emsifa.com/api-wilayah-indonesia/api/';

    $provinsi = Http::get("{$url}provinces.json")->json();
    $kabupaten = Http::get("{$url}regencies/{$request->provinsi}.json")->json();
    $kecamatan = Http::get("{$url}districts/{$request->kabupaten}.json")->json();
    $data['provinsi'] = collect($provinsi)->firstWhere('id', $request->provinsi)['name'];
    $data['provinsi_lahir'] = collect($provinsi)->firstWhere('id', $request->provinsi_lahir)['name'];
    $data['kabupaten'] = collect($kabupaten)->firstWhere('id', $request->kabupaten)['name'];
    $data['kecamatan'] = collect($kecamatan)->firstWhere('id', $request->kecamatan)['name'];
    $kabupaten = Http::get("{$url}regencies/{$request->provinsi_lahir}.json")->json();
    $data['kota_lahir'] = collect($kabupaten)->firstWhere('id', $request->kota_lahir)['name'];

    // dd($data);

    User::create([
      'nama_lengkap' => $request->nama_lengkap,
      'foto' => $data['foto'],
      'alamat_ktp' => $request->alamat_ktp,
      'alamat_saat_ini' => $request->alamat_saat_ini,
      'kecamatan' => $data['kecamatan'],
      'kabupaten' => $data['kabupaten'],
      'provinsi' => $data['provinsi'],
      'telepon' => $request->telepon,
      'hp' => $request->hp,
      'kewarganegaraan' => $data['kewarganegaraan'],
      'tgl_lahir' => $request->tgl_lahir,
      'kota_lahir' => $data['kota_lahir'],
      'provinsi_lahir' => $data['provinsi_lahir'],
      'jenis_kelamin' => $request->jenis_kelamin,
      'status_menikah' => $request->status_menikah,
      'agama_id' => $request->agama_id,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return redirect(route('login'))->with('verify', 'Data anda berhasil diinput. Setelah data anda terverifikasi, anda dapat melakukan pencetakan pendaftaran.');
  }
}
