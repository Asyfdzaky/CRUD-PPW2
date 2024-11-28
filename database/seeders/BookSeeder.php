<?php

namespace Database\Seeders;
use App\Models\Books;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan buku contoh
        DB::table('books')->insert([
            'title' => 'Learn Laravel',
            'author' => 'John Doe',
            'harga' => '100000',
            'tanggal_terbit' => '2023-10-01',
            'image' => 'images/laravel.jpg',
        ]);

        DB::table('books')->insert([
            'title' => 'PHP Mastery',
            'author' => 'Jane Doe',
            'harga' => '150000',
            'tanggal_terbit' => '2023-08-15',
            'image' => 'images/php_mastery.jpg',
        ]);

        DB::table('books')->insert([
            'title' => 'JavaScript for Beginners',
            'author' => 'Samuel Lee',
            'harga' => '120000',
            'tanggal_terbit' => '2023-05-20',
            'image' => 'images/js_beginners.jpg',
        ]);
    }
}
