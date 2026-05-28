<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = ['Politik', 'Teknologi', 'Olahraga', 'Hiburan', 'Edukasi'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        $dummyTags = ['HotNews', 'Viral', 'Trending', 'Jakarta', 'Tips', 'Gawai', 'Liga1', 'Sains'];
        foreach ($dummyTags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        $namaUser = ['Budi Santoso', 'Siti Aminah', 'Rian Wijaya', 'Dewi Lestari', 'Ahmad Fauzi'];
        foreach ($namaUser as $nama) {
            User::create([
                'name' => $nama,
                'email' => Str::slug($nama) . '@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        $this->call(ArticleSeeder::class);
    }
}
