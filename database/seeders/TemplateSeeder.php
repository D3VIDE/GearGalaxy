<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan ini untuk PostgreSQL sebagai pengganti FOREIGN_KEY_CHECKS
        DB::statement('SET session_replication_role = replica;');

        // Clear existing data
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        // Kembalikan ke pengaturan normal
        DB::statement('SET session_replication_role = DEFAULT;');

        // 4DB diatas digunakan untuk memastikan jika TemplateSeeder dijalankan lagi akan reset dari awal
        // dikarenakan foreign key tidak bisa langsung dihapus maka perlu cara seperti itu

        // 1. Insert roles data matching your schema
        $roles = [
            [
                'id' => 1,
                'role_name' => 'Admin'
            ],
            [
                'id' => 2,
                'role_name' => 'Regular User'
            ]
        ];

        DB::table('roles')->insert($roles);

        // 2. Create admin user matching your schema
        DB::table('users')->insert([
            'user_name' => 'System Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin@123'), // Strong password recommended
            'role_id' => 1, // Admin role
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
