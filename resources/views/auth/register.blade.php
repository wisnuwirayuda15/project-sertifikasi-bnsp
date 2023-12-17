<x-guest-layout>
  <form class="w-full" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <!-- Nama Lengkap -->
    <div>
      <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
      <x-text-input class="mt-1 block w-full" id="nama_lengkap" name="nama_lengkap" type="text" :value="old('nama_lengkap')" required autofocus autocomplete="nama_lengkap" />
      <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
    </div>

    <!-- Foto -->
    <div class="mt-4">
      <x-input-label for="foto" :value="__('Foto')" />
      <x-file-input class="mt-1 block w-full" id="foto" name="foto" type="file" />
      <x-input-error class="mt-2" :messages="$errors->get('foto')" />
    </div>

    <!-- Alamat KTP -->
    <div class="mt-4">
      <x-input-label for="alamat_ktp" :value="__('Alamat KTP')" />
      <x-text-input class="mt-1 block w-full" id="alamat_ktp" name="alamat_ktp" type="text" :value="old('alamat_ktp')" required />
      <x-input-error class="mt-2" :messages="$errors->get('alamat_ktp')" />
    </div>

    <!-- Alamat Saat Ini -->
    <div class="mt-4">
      <x-input-label for="alamat_saat_ini" :value="__('Alamat Saat Ini')" />
      <x-text-input class="mt-1 block w-full" id="alamat_saat_ini" name="alamat_saat_ini" type="text" :value="old('alamat_saat_ini')" required />
      <x-input-error class="mt-2" :messages="$errors->get('alamat_saat_ini')" />
    </div>

    <!-- Provinsi -->
    <div class="mt-4">
      <x-input-label for="provinsi" :value="__('Provinsi')" />
      <x-select-input class="w-full" id="provinsi" name="provinsi" :options="[]" :selected="old('provinsi')" required />
      <x-input-error class="mt-2" :messages="$errors->get('provinsi')" />
    </div>

    <!-- Kabupaten -->
    <div class="mt-4">
      <x-input-label for="kabupaten" :value="__('Kabupaten/Kota')" />
      <x-select-input class="w-full" id="kabupaten" name="kabupaten" :options="[]" :selected="old('kabupaten')" required />
      <x-input-error class="mt-2" :messages="$errors->get('kabupaten')" />
    </div>

    <!-- Kecamatan -->
    <div class="mt-4">
      <x-input-label for="kecamatan" :value="__('Kecamatan')" />
      <x-select-input class="w-full" id="kecamatan" name="kecamatan" :options="[]" :selected="old('kecamatan')" required />
      <x-input-error class="mt-2" :messages="$errors->get('kecamatan')" />
    </div>

    <!-- Telepon -->
    <div class="mt-4">
      <x-input-label for="telepon" :value="__('Telepon')" />
      <x-text-input class="mt-1 block w-full" id="telepon" name="telepon" type="tel" :value="old('telepon')" required />
      <x-input-error class="mt-2" :messages="$errors->get('telepon')" />
    </div>

    <!-- HP -->
    <div class="mt-4">
      <x-input-label for="hp" :value="__('HP')" />
      <x-text-input class="mt-1 block w-full" id="hp" name="hp" type="tel" :value="old('hp')" required />
      <x-input-error class="mt-2" :messages="$errors->get('hp')" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')" required autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <!-- Kewarganegaraan -->
    <div class="mt-4">
      <x-input-label for="kewarganegaraan" :value="__('Kewarganegaraan')" />
      <x-select-input class="w-full" id="kewarganegaraan" name="kewarganegaraan" :options="['WNI Asli', 'WNI Keturunan', 'WNA']" :selected="old('kewarganegaraan')" required />
      <x-input-error class="mt-2" :messages="$errors->get('kewarganegaraan')" />

      <x-text-input class="w-full" id="wna" name="wna" :value="old('wna')" placeholder="Bila WNA, sebutkan negaranya..." disabled />
      <x-input-error class="mt-2" :messages="$errors->get('wna')" />
    </div>

    <!-- Tanggal Lahir -->
    <div class="mt-4">
      <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
      <x-text-input class="mt-1 block w-full" id="tgl_lahir" name="tgl_lahir" type="date" :value="old('tgl_lahir')" required />
      <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
    </div>

    
    <!-- Provinsi Lahir -->
    {{-- <div class="mt-4">
      <x-input-label for="provinsi_lahir" :value="__('Provinsi Lahir')" />
      <x-text-input class="mt-1 block w-full" id="provinsi_lahir" name="provinsi_lahir" type="text" :value="old('provinsi_lahir')" required />
      <x-input-error class="mt-2" :messages="$errors->get('provinsi_lahir')" />
    </div> --}}
    <div class="mt-4">
      <x-input-label for="provinsi_lahir" :value="__('Provinsi Lahir')" />
      <x-select-input class="w-full" id="provinsi_lahir" name="provinsi_lahir" :options="[]" :selected="old('provinsi_lahir')" required />
      <x-input-error class="mt-2" :messages="$errors->get('provinsi_lahir')" />
    </div>

    <!-- Kota Lahir -->
    {{-- <div class="mt-4">
      <x-input-label for="kota_lahir" :value="__('Kota Lahir')" />
      <x-text-input class="mt-1 block w-full" id="kota_lahir" name="kota_lahir" type="text" :value="old('kota_lahir')" required />
      <x-input-error class="mt-2" :messages="$errors->get('kota_lahir')" />
    </div> --}}
    <div class="mt-4">
      <x-input-label for="kota_lahir" :value="__('Kota Lahir')" />
      <x-select-input class="w-full" id="kota_lahir" name="kota_lahir" :options="[]" :selected="old('kota_lahir')" required />
      <x-input-error class="mt-2" :messages="$errors->get('kota_lahir')" />
    </div>


    <!-- Jenis Kelamin -->
    <div class="mt-4">
      <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
      <x-select-input class="w-full" id="jenis_kelamin" name="jenis_kelamin" :options="['Pria', 'Wanita']" :selected="old('jenis_kelamin')" required />
      <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
    </div>

    <!-- Status Menikah -->
    <div class="mt-4">
      <x-input-label for="status_menikah" :value="__('Status Menikah')" />
      <x-select-input class="w-full" id="status_menikah" name="status_menikah" :options="['Belum Menikah', 'Menikah', 'Lain-lain']" :selected="old('status_menikah')" required />
      <x-input-error class="mt-2" :messages="$errors->get('status_menikah')" />
    </div>

    <!-- Agama -->
    <div class="mt-4">
      <x-input-label for="agama" :value="__('Agama')" />
      <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="agama_id" required>
        @foreach ($agama as $a)
          <option value="{{ $a->id }}" {{ $a->id == old('agama_id') ? 'selected' : '' }}>{{ $a->name }}</option>
        @endforeach
      </select>
      <x-input-error class="mt-2" :messages="$errors->get('agama_id')" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />
      <x-text-input class="mt-1 block w-full" id="password" name="password" type="password" required autocomplete="new-password" />
      <x-input-error class="mt-2" :messages="$errors->get('password')" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
      <x-text-input class="mt-1 block w-full" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
      <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
    </div>

    <div class="mt-4 flex items-center justify-end">
      <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>

  @push('scripts')
    <script>
      $(document).ready(function() {
        function selectInput(url, dropdown, placeholder) {
          $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
              $(dropdown).empty();
              if (placeholder) {
                $(dropdown).append(`<option>${placeholder}</option>`);
              }
              $.each(data, function(index, item) {
                $(dropdown).append(`<option value="${item.id}">${item.name}</option>`);
              });
            },
            error: function(error) {
              console.error('Error fetching data:', error);
            }
          });
        }
        selectInput('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', '#provinsi', 'Pilih Provinsi');
        selectInput('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', '#provinsi_lahir', 'Pilih Provinsi');
        $('#provinsi').on('change', function() {
          const selectedProvinsiId = $(this).val();
          if (selectedProvinsiId) {
            $('#kecamatan').empty();
            selectInput(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`, '#kabupaten', 'Pilih Kabupaten');
          } else {
            $('#kabupaten').empty();
          }
        });
        $('#provinsi_lahir').on('change', function() {
          const selectedProvinsiId = $(this).val();
          if (selectedProvinsiId) {
            $('#kota_lahir').empty();
            selectInput(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`, '#kota_lahir', 'Pilih Kabupaten');
          } else {
            $('#kota_lahir').empty();
          }
        });
        $('#kabupaten').on('change', function() {
          const selectedKabupatenId = $(this).val();
          if (selectedKabupatenId) {
            selectInput(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${selectedKabupatenId}.json`, '#kecamatan', 'Pilih Kecamatan');
          } else {
            $('#kecamatan').empty();
          }
        });
        $('#kewarganegaraan').on('change', function() {
          if ($(this).val() === 'WNA') {
            $('#wna').prop('disabled', false)
          } else {
            $('#wna').prop('disabled', true)
          }
        });
      });
    </script>
  @endpush
</x-guest-layout>
