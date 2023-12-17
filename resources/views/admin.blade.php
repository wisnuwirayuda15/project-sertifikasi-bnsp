<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Admin') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl overflow-x-auto rounded-xl bg-white p-10 sm:px-6 lg:px-8">
      <table class="table rounded-none" id="users">
        <thead class="border-2">
          <tr class="border-2">
            <th>No</th>
            <th>Foto</th>
            <th>Nama Lengkap</th>
            {{-- <th>Alamat KTP</th> --}}
            <th>Alamat Saat Ini</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            {{-- <th>Telepon</th> --}}
            <th>HP</th>
            <th>Kewarganegaraan</th>
            {{-- <th>Tanggal Lahir</th> --}}
            {{-- <th>Kota Lahir</th> --}}
            {{-- <th>Provinsi Lahir</th> --}}
            <th>Jenis Kelamin</th>
            {{-- <th>Status Menikah</th> --}}
            {{-- <th>Agama</th> --}}
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr class="hover:bg-base-200">
              <td>{{ $loop->iteration }}</td>
              <td><img class="w-20" src="{{ $user->foto }}" alt="foto"></td>
              <td>{{ $user->nama_lengkap }}</td>
              {{-- <td>{{ $user->alamat_ktp }}</td> --}}
              <td>{{ $user->alamat_saat_ini }}</td>
              <td>{{ $user->provinsi }}</td>
              <td>{{ $user->kabupaten }}</td>
              <td>{{ $user->kecamatan }}</td>
              {{-- <td>{{ $user->telepon }}</td> --}}
              <td>{{ $user->hp }}</td>
              <td>{{ $user->kewarganegaraan }}</td>
              {{-- <td>{{ $user->tgl_lahir }}</td> --}}
              {{-- <td>{{ $user->kota_lahir }}</td> --}}
              {{-- <td>{{ $user->provinsi_lahir }}</td> --}}
              <td>{{ $user->jenis_kelamin }}</td>
              {{-- <td>{{ $user->status_menikah }}</td> --}}
              {{-- <td>{{ $user->agama->name }}</td> --}}
              <td class="grid gap-1">
                <form method="POST" action="{{ route('verify', $user->id) }}">
                  @csrf
                  @method('PATCH')
                  <button onclick="return confirm('Apakah data calon mahasiswa sudah benar?')" class="btn btn-primary btn-xs w-full" type="submit" @disabled($user->email_verified_at)>Verifikasi</button>
                </form>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary btn-xs w-full">Edit</a>
                <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')" class="btn btn-accent btn-xs w-full" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  @if (session('verify'))
    @push('scripts')
      <script>
        Swal.fire({
          text: `{{ session('verify') }}`,
          icon: "success"
        });
      </script>
    @endpush
  @endif

  @if (session('destroy'))
    @push('scripts')
      <script>
        Swal.fire({
          text: `{{ session('destroy') }}`,
          icon: "success"
        });
      </script>
    @endpush
  @endif

  @if (session('update'))
    @push('scripts')
      <script>
        Swal.fire({
          text: `{{ session('update') }}`,
          icon: "success"
        });
      </script>
    @endpush
  @endif

  @push('scripts')
    <script>
      $(document).ready(function() {
        $('#users').DataTable();
      });
    </script>
  @endpush
</x-app-layout>
