<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([ 
            'nama' => 'Administrator', 
            'email' => 'admin@gmail.com', 
            'role' => '1',
            'status' => 1, 
            'hp' => '0812345678901', 
            'password' => bcrypt('P@55word'), 
        ]); 
        User::create([ 
            'nama' => 'Sopian Aji', 
            'email' => 'sopian4ji@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('P@55word'), 
        ]);
        User::create([ 
            'nama' => 'Aji', 
            'email' => 'aji@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('P@55word'), 
        ]);
        User::create([ 
            'nama' => 'Sopian', 
            'email' => 'sopian@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('P@55word'), 
        ]);
        User::create([ 
            'nama' => ' ji', 
            'email' => 'jiji@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('P@55word'), 
        ]);
        User::create([ 
            'nama' => 'Haikal Siregar', 
            'email' => 'awikwok@gmail.com', 
            'role' => '0', 
            'status' => 1, 
            'hp' => '081234567892', 
            'password' => bcrypt('123456'), 
        ]);
        #data kategori
        Kategori::create([
            'nama_kategori' => 'Brownies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Combro',
        ]);
        Kategori::create([
            'nama_kategori' => 'Dawet',
        ]);
        Kategori::create([
            'nama_kategori' => 'Mochi',
        ]);
        Kategori::create([
            'nama_kategori' => 'Wingko',
        ]);
    }
}
