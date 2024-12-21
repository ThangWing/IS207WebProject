<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(BenhlySeeder::class);
        $this->call(ClsSeeder::class);
        $this->call(KhoaSeeder::class);
        $this->call(ThuocSeeder::class);
        $this->call(PhongKhamSeeder::class);
        $this->call(LichlamviecSeeder::class);
        $this->call(BenhnhanSeeder::class);
        $this->call(BHYTSeeder::class);
        $this->call(BacSiSeeder::class);
    }
}
