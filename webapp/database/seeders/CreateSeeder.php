<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class CreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'author_name' => "山田太郎",
        ]);

        Author::create([
            'author_name' => '田中花子',
        ]);

        Author::create([
            'author_name' => '佐藤次郎',
        ]);
    }
}
