<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View
  {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    // if ($request->user()->isDirty('email')) {
    //   $request->user()->email_verified_at = null;
    // }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validateWithBag('userDeletion', [
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }


  public function verify(User $user)
  {
    $user->update([
      'email_verified_at' => now()
    ]);

    return back()->with('verify', "Data pendaftaran {$user->nama_lengkap} telah terverifikasi.");
  }

  public function editData()
  {
    $agama = Agama::all();
    $user = auth()->user();
    return view('data-diri', compact('agama', 'user'));
  }

  public function updateData(Request $request, User $user)
  {
    // dd($request->all());
    $rules = [
      'nama_lengkap' => ['required', 'string', 'max:255'],
      'alamat_ktp' => ['required', 'string', 'max:255'],
      'alamat_saat_ini' => ['required', 'string', 'max:255'],
      'kecamatan' => ['required', 'string', 'max:255'],
      'kabupaten' => ['required', 'string', 'max:255'],
      'provinsi' => ['required', 'string', 'max:255'],
      'telepon' => ['required', 'numeric', 'min:10'],
      'hp' => ['required', 'numeric', 'min:10'],
      'kewarganegaraan' => ['required', 'string', 'in:WNI Asli,WNI Keturunan,WNA'],
      'wna' => ['string', 'max:255'],
      'tgl_lahir' => ['required', 'date'],
      'kota_lahir' => ['required', 'string', 'max:255'],
      'provinsi_lahir' => ['required', 'string', 'max:255'],
      'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
      'status_menikah' => ['required', 'in:Belum Menikah,Menikah,Lain-lain'],
      'agama_id' => ['required', Rule::in(Agama::pluck('id')->all())],

      'foto' => ['image', 'file', 'max:2000'],
    ];

    $data = $request->validate($rules);

    if ($request->foto) {
      if (auth()->user()->foto) {
        unlink(public_path(auth()->user()->foto));
      }
      $foto = fake()->uuid() . '.' . $data['foto']->extension();
      $request->file('foto')->move(public_path('/img/foto'), $foto);
      $data['foto'] = "/img/foto/$foto";
    }

    if ($request->wna) {
      $data['kewarganegaraan'] = $request->wna;
    }

    $url= 'https://www.emsifa.com/api-wilayah-indonesia/api/';

    if ($request->provinsi != auth()->user()->provinsi) {
      $provinsi = Http::get("{$url}provinces.json")->json();
      $kabupaten = Http::get("{$url}regencies/{$request->provinsi}.json")->json();
      $kecamatan = Http::get("{$url}districts/{$request->kabupaten}.json")->json();
      $data['provinsi'] = collect($provinsi)->firstWhere('id', $request->provinsi)['name'];
      $data['kabupaten'] = collect($kabupaten)->firstWhere('id', $request->kabupaten)['name'];
      $data['kecamatan'] = collect($kecamatan)->firstWhere('id', $request->kecamatan)['name'];
    }
    if ($request->provinsi_lahir != auth()->user()->provinsi_lahir) {
      $provinsi = Http::get("{$url}provinces.json")->json();
      $kabupaten = Http::get("{$url}regencies/{$request->provinsi_lahir}.json")->json();
      $data['provinsi_lahir'] = collect($provinsi)->firstWhere('id', $request->provinsi_lahir)['name'];
      $data['kota_lahir'] = collect($kabupaten)->firstWhere('id', $request->kota_lahir)['name'];
    }

    // dd($data);

    auth()->user()->update([
      'nama_lengkap' => $request->nama_lengkap,
      'alamat_ktp' => $request->alamat_ktp,
      'alamat_saat_ini' => $request->alamat_saat_ini,
      'kecamatan' => $data['kecamatan'],
      'kabupaten' => $data['kabupaten'],
      'provinsi' => $data['provinsi'],
      'telepon' => $request->telepon,
      'hp' => $request->hp,
      'kewarganegaraan' => $data['kewarganegaraan'],
      'tgl_lahir' => $request->tgl_lahir,
      'kota_lahir' => $request->kota_lahir,
      'provinsi_lahir' => $request->provinsi_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'status_menikah' => $request->status_menikah,
      'agama_id' => $request->agama_id,
      'email_verified_at' => null
    ]);

    if ($request->foto) {
      auth()->user()->update([
        'foto' => $data['foto'],
      ]);
    }

    return redirect(route('dashboard'))->with('update', 'Data anda telah berhasil diedit dan perlu diverifikasi ulang.');
  }

  public function cetak()
  {
    if (!auth()->user()->email_verified_at) {
      return back();
    }
    $user = auth()->user();
    $pdf = Pdf::loadView('cetak', compact('user'));
    return $pdf->stream();
  }

  public function editUser(User $user)
  {
    $agama = Agama::all();
    return view('edit-user', compact('agama', 'user'));
  }

  public function destroyUser(User $user)
  {
    $name = $user->nama_lengkap;
    if ($user->foto) {
      unlink(public_path($user->foto));
    }
    $user->delete();
    return back()->with('destroy', "{$name} telah dihapus dari pendaftaran.");
  }

  public function updateUser(Request $request, User $user)
  {
    // dd($request->all());
    $rules = [
      'nama_lengkap' => ['required', 'string', 'max:255'],
      'alamat_ktp' => ['required', 'string', 'max:255'],
      'alamat_saat_ini' => ['required', 'string', 'max:255'],
      'kecamatan' => ['required', 'string', 'max:255'],
      'kabupaten' => ['required', 'string', 'max:255'],
      'provinsi' => ['required', 'string', 'max:255'],
      'telepon' => ['required', 'numeric', 'min:10'],
      'hp' => ['required', 'numeric', 'min:10'],
      'kewarganegaraan' => ['required', 'string', 'in:WNI Asli,WNI Keturunan,WNA'],
      'wna' => ['string', 'max:255'],
      'tgl_lahir' => ['required', 'date'],
      'kota_lahir' => ['required', 'string', 'max:255'],
      'provinsi_lahir' => ['required', 'string', 'max:255'],
      'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
      'status_menikah' => ['required', 'in:Belum Menikah,Menikah,Lain-lain'],
      'agama_id' => ['required', Rule::in(Agama::pluck('id')->all())],

      'foto' => ['image', 'file', 'max:2000'],
    ];

    $data = $request->validate($rules);

    if ($request->foto) {
      if ($user->foto) {
        unlink(public_path($user->foto));
      }
      $foto = fake()->uuid() . '.' . $data['foto']->extension();
      $request->file('foto')->move(public_path('/img/foto'), $foto);
      $data['foto'] = "/img/foto/$foto";
    }

    if ($request->wna) {
      $data['kewarganegaraan'] = $request->wna;
    }

    $url= 'https://www.emsifa.com/api-wilayah-indonesia/api/';

    if ($request->provinsi != $user->provinsi) {
      $provinsi = Http::get("{$url}provinces.json")->json();
      $kabupaten = Http::get("{$url}regencies/{$request->provinsi}.json")->json();
      $kecamatan = Http::get("{$url}districts/{$request->kabupaten}.json")->json();
      $data['provinsi'] = collect($provinsi)->firstWhere('id', $request->provinsi)['name'];
      $data['kabupaten'] = collect($kabupaten)->firstWhere('id', $request->kabupaten)['name'];
      $data['kecamatan'] = collect($kecamatan)->firstWhere('id', $request->kecamatan)['name'];
    }
    if ($request->provinsi_lahir != $user->provinsi_lahir) {
      $provinsi = Http::get("{$url}provinces.json")->json();
      $kabupaten = Http::get("{$url}regencies/{$request->provinsi_lahir}.json")->json();
      $data['provinsi_lahir'] = collect($provinsi)->firstWhere('id', $request->provinsi_lahir)['name'];
      $data['kota_lahir'] = collect($kabupaten)->firstWhere('id', $request->kota_lahir)['name'];
    }

    // dd($data);

    $user->update([
      'nama_lengkap' => $request->nama_lengkap,
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
      'email_verified_at' => null
    ]);

    if ($request->foto) {
      $user->update([
        'foto' => $data['foto'],
      ]);
    }

    return redirect(route('admin'))->with('update', 'Data user telah berhasil diedit.');
  }
}
