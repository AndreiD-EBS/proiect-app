<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 30) as $i) {
            $faker = Faker::create();
            $title = "Sample Headline {$i}: " . $faker->sentence(6);
            Article::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $i,
                'excerpt' => $faker->paragraph(),
                'body' => $faker->paragraphs(8, true),
                'category' => $faker->randomElement(['News', 'Culture', 'Tech', 'Sports', 'Opinion']),
                'author_name' => $faker->name(),
                'published_at' => now()->subDays(rand(0, 30))->subMinutes(rand(0, 600)),
                'is_published' => true,
            ]);
        }
    }
}
