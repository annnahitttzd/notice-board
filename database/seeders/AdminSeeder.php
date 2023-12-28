<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin1234'),
        ]);
        $additionalAdmins = [
            [
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('Admin5678'),
            ],
        ];
        foreach ($additionalAdmins as $admin) {
            Admin::create($admin);
        }
    }
}
