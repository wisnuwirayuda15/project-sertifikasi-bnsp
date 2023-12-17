<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Edit Data Diri') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white p-5 shadow-sm sm:rounded-lg">
        <form class="w-full" method="POST" action="{{ route('data.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <!-- Nama Lengkap -->
          <div>
            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
            <x-text-input class="mt-1 block w-full" id="nama_lengkap" name="nama_lengkap" type="text" :value="old('nama_lengkap', $user->nama_lengkap)" required autofocus autocomplete="nama_lengkap" />
            <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
          </div>

          <!-- Foto -->
          <div class="mt-4">
            <x-input-label for="foto" :value="__('Foto')" />
            <img class="w-32" src="{{ $user->foto }}" alt="foto">
            <x-file-input class="mt-1 block w-full" id="foto" name="foto" type="file" />
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
          </div>

          <!-- Alamat KTP -->
          <div class="mt-4">
            <x-input-label for="alamat_ktp" :value="__('Alamat KTP')" />
            <x-text-input class="mt-1 block w-full" id="alamat_ktp" name="alamat_ktp" type="text" :value="old('alamat_ktp', $user->alamat_ktp)" required />
            <x-input-error class="mt-2" :messages="$errors->get('alamat_ktp')" />
          </div>

          <!-- Alamat Saat Ini -->
          <div class="mt-4">
            <x-input-label for="alamat_saat_ini" :value="__('Alamat Saat Ini')" />
            <x-text-input class="mt-1 block w-full" id="alamat_saat_ini" name="alamat_saat_ini" type="text" :value="old('alamat_saat_ini', $user->alamat_saat_ini)" required />
            <x-input-error class="mt-2" :messages="$errors->get('alamat_saat_ini')" />
          </div>
          @php
            $kab = [$user->kabupaten];
          @endphp
          <!-- Provinsi -->
          <div class="mt-4">
            <x-input-label for="provinsi" :value="__('Provinsi')" />
            <x-select-input class="w-full" id="provinsi" name="provinsi" :options="[]" :selected="old('provinsi')" required />
            <x-input-error class="mt-2" :messages="$errors->get('provinsi')" />
          </div>

          <!-- Kabupaten -->
          <div class="mt-4">
            <x-input-label for="kabupaten" :value="__('Kabupaten')" />
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
            <x-text-input class="mt-1 block w-full" id="telepon" name="telepon" type="tel" :value="old('telepon', $user->telepon)" required />
            <x-input-error class="mt-2" :messages="$errors->get('telepon')" />
          </div>

          <!-- HP -->
          <div class="mt-4">
            <x-input-label for="hp" :value="__('HP')" />
            <x-text-input class="mt-1 block w-full" id="hp" name="hp" type="tel" :value="old('hp', $user->hp)" required />
            <x-input-error class="mt-2" :messages="$errors->get('hp')" />
          </div>

          @php
            $wni = $user->kewarganegaraan == 'WNI Asli' || $user->kewarganegaraan == 'WNI Keturunan' ? $user->kewarganegaraan : null;
            $wna = $user->kewarganegaraan == 'WNI Asli' || $user->kewarganegaraan == 'WNI Keturunan' ? null : $user->kewarganegaraan;
          @endphp

          <!-- Kewarganegaraan -->
          <div class="mt-4">
            <x-input-label for="kewarganegaraan" :value="__('Kewarganegaraan')" />
            <x-select-input class="w-full" id="kewarganegaraan" name="kewarganegaraan" :options="['WNI Asli', 'WNI Keturunan', 'WNA']" :selected="old('kewarganegaraan', $wni)" required />
            <x-input-error class="mt-2" :messages="$errors->get('kewarganegaraan')" />

            <x-text-input class="w-full" id="wna" name="wna" :value="old('wna', $wna)" placeholder="Bila WNA, sebutkan negaranya..." disabled />
            <x-input-error class="mt-2" :messages="$errors->get('wna')" />
          </div>

          <!-- Tanggal Lahir -->
          <div class="mt-4">
            <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input class="mt-1 block w-full" id="tgl_lahir" name="tgl_lahir" type="date" :value="old('tgl_lahir', $user->tgl_lahir)" required />
            <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
          </div>

          <!-- Kota Lahir -->
          <div class="mt-4">
            <x-input-label for="kota_lahir" :value="__('Kota Lahir')" />
            <x-text-input class="mt-1 block w-full" id="kota_lahir" name="kota_lahir" type="text" :value="old('kota_lahir', $user->kota_lahir)" required />
            <x-input-error class="mt-2" :messages="$errors->get('kota_lahir')" />
          </div>

          <!-- Provinsi Lahir -->
          <div class="mt-4">
            <x-input-label for="provinsi_lahir" :value="__('Provinsi Lahir')" />
            <x-text-input class="mt-1 block w-full" id="provinsi_lahir" name="provinsi_lahir" type="text" :value="old('provinsi_lahir', $user->provinsi_lahir)" required />
            <x-input-error class="mt-2" :messages="$errors->get('provinsi_lahir')" />
          </div>

          <!-- Jenis Kelamin -->
          <div class="mt-4">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <x-select-input class="w-full" id="jenis_kelamin" name="jenis_kelamin" :options="['Pria', 'Wanita']" :selected="old('jenis_kelamin', $user->jenis_kelamin)" required />
            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
          </div>

          <!-- Status Menikah -->
          <div class="mt-4">
            <x-input-label for="status_menikah" :value="__('Status Menikah')" />
            <x-select-input class="w-full" id="status_menikah" name="status_menikah" :options="['Belum Menikah', 'Menikah', 'Lain-lain']" :selected="old('status_menikah', $user->status_menikah)" required />
            <x-input-error class="mt-2" :messages="$errors->get('status_menikah')" />
          </div>

          <!-- Agama -->
          <div class="mt-4">
            <x-input-label for="agama" :value="__('Agama')" />
            <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="agama_id" required>
              @foreach ($agama as $a)
                <option value="{{ $a->id }}" {{ $a->id == old('agama_id', $user->agama->id) ? 'selected' : '' }}>{{ $a->name }}</option>
              @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('agama_id')" />
          </div>

          <div class="mt-4 flex items-center justify-end">
            <x-primary-button class="ms-4">
              {{ __('Simpan') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>

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
        selectInput('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json', '#provinsi', '{{ $user->provinsi }}');
        $('#kabupaten').append(`<option>{{ $user->kabupaten }}</option>`);
        $('#kecamatan').append(`<option>{{ $user->kecamatan }}</option>`);
        $('#provinsi').on('change', function() {
          const selectedProvinsiId = $(this).val();
          if (selectedProvinsiId) {
            $('#kecamatan').empty();
            selectInput(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`, '#kabupaten', 'Pilih Kabupaten');
          } else {
            $('#kabupaten').empty();
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
</x-app-layout>
