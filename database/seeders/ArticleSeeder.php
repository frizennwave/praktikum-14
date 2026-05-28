<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Http;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Storage;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->error('Jalankan UserSeeder terlebih dahulu sebelum ArticleSeeder!');
            return;
        }

        $techCategory = Category::where('name', 'like', '%Teknologi%')->orWhere('slug', 'like', '%teknologi%')->first() ?? Category::first();
        $sportsCategory = Category::where('name', 'like', '%Olahraga%')->orWhere('slug', 'like', '%olahraga%')->first() ?? Category::first();
        $economyCategory = Category::where('name', 'like', '%Ekonomi%')->orWhere('slug', 'like', '%ekonomi%')->first() ?? Category::first();
        $entertainmentCategory = Category::where('name', 'like', '%Hiburan%')->orWhere('slug', 'like', '%hiburan%')->first() ?? Category::first();

        $dummyArticles = [
            [
                'title' => 'Teknologi AI Diprediksi Akan Mengubah Pola Kerja Kantoran di Tahun 2026',
                'category_id' => $techCategory->id,
                'content' => 'Kecerdasan buatan kini semakin matang. Berbagai sektor industri mulai mengadopsi sistem otomatisasi tingkat tinggi yang efisien. Para ahli memprediksi sistem ini akan membantu memotong waktu kerja administratif hingga 40%.',
                'image_url' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=800'
            ],
            [
                'title' => 'Laravel 13 Resmi Dirilis, Apa Saja Fitur Barunya?',
                'category_id' => $techCategory->id,
                'content' => 'Framework PHP terpopuler ini kembali membawa pembaruan performa yang signifikan untuk developer. Pembaruan mencakup integrasi native yang lebih baik dengan ekosistem modern, optimalisasi routing cache, dan manajemen memori yang lebih efisien.',
                'image_url' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=800'
            ],
            [
                'title' => 'Timnas Indonesia Melaju ke Babak Final Piala Asia',
                'category_id' => $sportsCategory->id,
                'content' => 'Kemenangan dramatis lewat adu penalti membuat seluruh stadion bergemuruh malam ini. Perjuangan tanpa lelah skuad Garuda berhasil menorehkan sejarah baru di kancah sepak bola Asia.',
                'image_url' => 'https://images.unsplash.com/photo-1508098682722-e99c43a406b2?q=80&w=800'
            ],
            [
                'title' => 'Pasar Saham Meroket Pasca Pengumuman Suku Bunga Baru',
                'category_id' => $economyCategory->id,
                'content' => 'Investor merespon positif langkah bank sentral dalam menjaga stabilitas nilai tukar mata uang. Indeks harga saham gabungan langsung melonjak tajam sesaat setelah rilis pers resmi dikeluarkan.',
                'image_url' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=800'
            ],
            [
                'title' => 'Konser Band Legendaris di Jakarta Berlangsung Spektakuler',
                'category_id' => $entertainmentCategory->id,
                'content' => 'Puluhan ribu fans memadati area stadion sejak siang hari demi melihat penampilan sang idola. Konser yang berlangsung selama 3 jam ini ditutup dengan pesta kembang api yang sangat megah.',
                'image_url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=800'
            ]
        ];

        if (!Storage::disk('public')->exists('articles')) {
            Storage::disk('public')->makeDirectory('articles');
        }

        foreach ($dummyArticles as $item) {
            $imagePath = null;

            try {
                $response = Http::get($item['image_url']);

                if ($response->successful()) {
                    $filename = 'articles/' . Str::random(10) . '.jpg';

                    Storage::disk('public')->put($filename, $response->body());
                    $imagePath = $filename;
                }
            } catch (\Exception $e) {
                $this->command->warn("Gagal mengunduh gambar untuk: " . $item['title']);
            }

            Article::create([
                'title'       => $item['title'],
                'slug'        => Str::slug($item['title']),
                'content'     => $item['content'],
                'image'       => $imagePath,
                'category_id' => $item['category_id'],
                'user_id'     => $user->id,
                'created_at'  => now()->subHours(rand(1, 24)),
                'updated_at'  => now(),
            ]);
        }

        $this->command->info('Seeder artikel dengan gambar asli berhasil dijalankan!');
    }
}
