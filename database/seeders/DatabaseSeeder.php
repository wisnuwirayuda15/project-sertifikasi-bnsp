<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Agama;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $a = Agama::create([
      'name' => 'Hindu'
    ]);
    Agama::create([
      'name' => 'Islam'
    ]);
    Agama::create([
      'name' => 'Katolik'
    ]);
    Agama::create([
      'name' => 'Kristen'
    ]);
    Agama::create([
      'name' => 'Budha'
    ]);
    Agama::create([
      'name' => 'Khonghucu'
    ]);

    User::create([
      'nama_lengkap' => 'Admin',
      'email' => 'admin@example.com',
      'password' => bcrypt('12345678'),
      'is_admin' => true,
      'agama_id' => $a->id
    ]);
  }
}
