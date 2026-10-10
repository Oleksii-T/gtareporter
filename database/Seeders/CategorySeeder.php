<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds of pages and related blocks.
     *
     * @return void
     */
    public function run()
    {
        $schemas = [
            [
                'name' => 'Latest news',
                'meta_title' => 'Latest GTA VI News',
                'meta_description' => 'The latest GTA VI stories, official trailers, characters and news from Leonida.',
                'description' => 'Your latest dispatch from Vice City and beyond.',
                'slug' => 'news',
                'in_menu' => true,
                'order' => 1,
            ],
        ];

        foreach ($schemas as $schema) {
            Category::firstOrCreate(['slug' => $schema['slug']], $schema);
        }
    }
}
