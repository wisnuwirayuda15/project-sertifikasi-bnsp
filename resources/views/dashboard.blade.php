<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Data Pendaftaran') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white p-5 shadow-sm sm:rounded-lg">
        <!-- Nama Lengkap -->
        <div>
          <x-input-label :value="__('Nama Lengkap')" />
          <x-text-input class="mt-1 block w-full" id="nama_lengkap" name="nama_lengkap" type="text" :value="auth()->user()->nama_lengkap" readonly />
        </div>

        <!-- Foto -->
        <div class="mt-4">
          <x-input-label :value="__('Foto')" />
          <img class="w-32" src="{{ auth()->user()->foto }}" alt="foto">
        </div>

        <!-- Alamat KTP -->
        <div class="mt-4">
          <x-input-label :value="__('Alamat KTP')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->alamat_ktp" readonly />
        </div>

        <!-- Alamat Saat Ini -->
        <div class="mt-4">
          <x-input-label :value="__('Alamat Saat Ini')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->alamat_saat_ini" readonly />
        </div>

        <!-- Provinsi -->
        <div class="mt-4">
          <x-input-label :value="__('Provinsi')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->provinsi" readonly />
        </div>

        <!-- Kabupaten -->
        <div class="mt-4">
          <x-input-label :value="__('Kabupaten')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->kabupaten" readonly />
        </div>

        <!-- Kecamatan -->
        <div class="mt-4">
          <x-input-label :value="__('Kecamatan')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->kecamatan" readonly />
        </div>

        <!-- Telepon -->
        <div class="mt-4">
          <x-input-label :value="__('Nomor Telepon')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->telepon" readonly />
        </div>

        <!-- HP -->
        <div class="mt-4">
          <x-input-label :value="__('Nomor HP')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->hp" readonly />
        </div>

        <!-- Kewarganegaraan -->
        <div class="mt-4">
          <x-input-label :value="__('Kewarganegaraan')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->kewarganegaraan" readonly />
        </div>

        <!-- Tanggal Lahir -->
        <div class="mt-4">
          <x-input-label :value="__('Tanggal Lahir')" />
          <x-text-input class="mt-1 block w-full" type="date" :value="auth()->user()->tgl_lahir" readonly />
        </div>

        <!-- Kota Lahir -->
        <div class="mt-4">
          <x-input-label :value="__('Kota Lahir')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->kota_lahir" readonly />
        </div>

        <!-- Provinsi Lahir -->
        <div class="mt-4">
          <x-input-label :value="__('Provinsi Lahir')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->provinsi_lahir" readonly />
        </div>

        <!-- Jenis Kelamin -->
        <div class="mt-4">
          <x-input-label :value="__('Jenis Kelamin')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->jenis_kelamin" readonly />
        </div>

        <!-- Status Menikah -->
        <div class="mt-4">
          <x-input-label :value="__('Status Menikah')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->status_menikah" readonly />
        </div>

        <!-- Agama -->
        <div class="mt-4">
          <x-input-label :value="__('Agama')" />
          <x-text-input class="mt-1 block w-full" :value="auth()->user()->agama->name" readonly />
        </div>

        <div class="mt-4 flex justify-end">
          @if (!auth()->user()->email_verified_at)
            <p class="text-red-500">Data anda belum terverifikasi.</p>
          @else
            <p class="text-green-500">Data anda sudah terverifikasi, tekan tombol CETAK untuk menyelesaikan pendaftaran.</p>
          @endif
        </div>

        <div class="mt-1 flex items-center justify-end gap-2">
          <a href="{{ route('data.edit') }}">
            <x-secondary-button>
              {{ __('Edit') }}
            </x-secondary-button>
          </a>

          @if (auth()->user()->email_verified_at)
            <a href="{{ route('cetak') }}">
              <x-primary-button>
                {{ __('Cetak') }}
              </x-primary-button>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>

  @if (!auth()->user()->email_verified_at && !session('update')) 
    @push('scripts')
      <script>
        Swal.fire({
          text: "Data anda sedang dalam proses verifikasi, anda belum dapat melakukan pencetakan pendaftaran.",
          icon: "warning"
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
</x-app-layout>
