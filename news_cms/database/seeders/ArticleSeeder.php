<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology'],
            ['name' => 'Business', 'slug' => 'business'],
            ['name' => 'Politics', 'slug' => 'politics'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Entertainment', 'slug' => 'entertainment'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Tags
        $tags = ['Breaking', 'AI', 'Economy', 'World', 'Local', 'Feature'];
        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        // Create a default user if none exists
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create Articles
        $techCategory = Category::where('slug', 'technology')->first();
        $businessCategory = Category::where('slug', 'business')->first();

        Article::create([
            'title' => 'Revolutionary AI Chip Announced',
            'slug' => 'revolutionary-ai-chip-announced',
            'excerpt' => 'A new processor promises to triple the speed of LLM training while reducing energy costs.',
            'content' => 'In a move that caught competitors off guard, TechNova Corp announced their latest neural processing unit today. The chip, named "Synapse-X", represents a significant leap forward in semiconductor technology. Experts say this could halve the time required to train large language models.',
            'status' => 'published',
            'featured' => true,
            'user_id' => $user->id,
            'category_id' => $techCategory->id,
            'published_at' => now(),
        ]);

        Article::create([
            'title' => 'Market Surge Reaches Record Highs',
            'slug' => 'market-surge-reaches-record-highs',
            'excerpt' => 'Global indices jumped 2% on positive inflation data and strong job growth figures.',
            'content' => 'Investors cheered as the latest economic reports showed resilient growth without overheating. The tech sector led the charge, with major players seeing gains of over 4%. Analysts suggest a "soft landing" is now more likely than ever.',
            'status' => 'published',
            'featured' => false,
            'user_id' => $user->id,
            'category_id' => $businessCategory->id,
            'published_at' => now()->subHours(2),
        ]);

        Article::create([
            'title' => 'The Future of Renewable Energy',
            'slug' => 'future-of-renewable-energy',
            'excerpt' => 'Offshore wind and next-gen solar are poised to overtake coal by 2028.',
            'content' => 'The transition to clean power is accelerating. Recent breakthroughs in long-duration energy storage are solving the intermittency problem of renewables. Policy changes in major economies are further incentivizing the shift away from fossil fuels.',
            'status' => 'published',
            'featured' => true,
            'user_id' => $user->id,
            'category_id' => $techCategory->id,
            'published_at' => now()->subDays(1),
        ]);
        
        // Draft article
        Article::create([
            'title' => 'Upcoming Elections: What to Watch',
            'slug' => 'upcoming-elections-what-to-watch',
            'excerpt' => 'A deep dive into the swing states and key demographics that will decide the next leader.',
            'content' => 'Detailed analysis of political trends and polling data...',
            'status' => 'draft',
            'featured' => false,
            'user_id' => $user->id,
            'category_id' => Category::where('slug', 'politics')->first()->id,
        ]);
        
        // Attach some tags to articles
        $breakingTag = Tag::where('slug', 'breaking')->first();
        $aiTag = Tag::where('slug', 'ai')->first();
        
        $a1 = Article::where('slug', 'revolutionary-ai-chip-announced')->first();
        $a1->tags()->attach([$breakingTag->id, $aiTag->id]);
    }
}