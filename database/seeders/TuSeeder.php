<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tata;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'Tata Usaha',
            'email' => 'tu@admin.com',
            'password' => Hash::make('123456')
        ]);
    }
}
