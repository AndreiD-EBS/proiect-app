<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 30) as $i) {
            $title = "Sample Headline {$i}: " . fake()->sentence(6);

            Article::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . $i,
                'excerpt' => fake()->paragraph(),
                'body' => fake()->paragraphs(8, true),
                'category' => fake()->randomElement(['News', 'Culture', 'Tech', 'Sports', 'Opinion']),
                'author_name' => fake()->name(),
                'published_at' => now()->subDays(rand(0, 30))->subMinutes(rand(0, 600)),
                'is_published' => true,
            ]);
        }
    }
}
