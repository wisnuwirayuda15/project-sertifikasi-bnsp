<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->boolean('is_admin')->default(false);
      $table->string('nama_lengkap');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('foto')->nullable();
      $table->string('alamat_ktp')->nullable();
      $table->string('alamat_saat_ini')->nullable();
      $table->string('kecamatan')->nullable();
      $table->string('kabupaten')->nullable();
      $table->string('provinsi')->nullable();
      $table->string('telepon')->nullable();
      $table->string('hp')->unique()->nullable();
      $table->string('kewarganegaraan')->nullable();
      $table->date('tgl_lahir')->nullable();
      $table->string('kota_lahir')->nullable();
      $table->string('provinsi_lahir')->nullable();
      $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
      $table->enum('status_menikah', ['Belum Menikah', 'Menikah', 'Lain-lain'])->nullable();
      $table->foreignId('agama_id')->constrained();
      $table->timestamp('email_verified_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
