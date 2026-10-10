<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Enums\PostTCStyle;
use App\Models\Attachment;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/** Optional, additive starter articles for a local design preview. */
class GtaViDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment('local', 'testing')) {
            $this->command?->warn('GTA VI preview content is only available in local/testing environments.');

            return;
        }

        $category = Category::where('slug', 'news')->firstOrFail();
        $author = Author::firstOrCreate(['slug' => 'vi-news-desk'], [
            'name' => 'VI News Desk', 'title' => 'The Leonida dispatch',
            'description' => 'Independent coverage of the world of Grand Theft Auto VI.',
            'description_small' => 'Your Vice City connection.',
            'meta_title' => 'VI News Desk', 'meta_description' => 'Meet the GTA VI News editorial desk.',
        ]);
        $worldSource = 'https://www.rockstargames.com/VI/only-in-leonida';
        $mediaSource = 'https://www.rockstargames.com/VI/media';
        $stories = [
            ['vice-city-after-dark', 'Vice City after dark: a first look at the skyline', 'The world', 'vice-city.jpg', 'Vice City returns as part of Leonida. Rockstar’s official imagery gives us a glimpse of the waterfront, high-rise skyline and the city’s unmistakable atmosphere.', $worldSource],
            ['jason-and-lucia', 'Jason & Lucia: two lives, one way out', 'Characters', 'trailer-2.jpg', 'Jason Duval and Lucia Caminos sit at the heart of GTA VI. Their partnership connects the story’s personal stakes to a wider criminal conspiracy.', 'https://www.rockstargames.com/VI'],
            ['gta-vi-official-trailers', 'Roll the tape. The official GTA VI trailers, in one place', 'Trailers', 'trailer-1.jpg', 'Rockstar’s media library brings together official GTA VI videos. Watch the footage directly at the source, then take another look at the details.', $mediaSource],
            ['meet-jason-duval', 'Meet Jason Duval, a man looking for an easier life', 'Characters', 'jason.jpg', 'Jason’s background includes time in the Army and work with drug runners in the Keys. Rockstar’s character profile introduces the man behind one half of GTA VI’s central duo.', $worldSource],
            ['meet-lucia-caminos', 'Lucia Caminos is ready to change the odds', 'Characters', 'lucia.jpg', 'Lucia’s story begins with a fresh start after prison. Her official profile presents a determined character who wants a better life and is prepared to act on it.', $worldSource],
            ['gta-vi-media-library', 'Your window into Leonida: the official screenshot collection', 'Screenshots', 'key-art.jpg', 'Explore the official screenshot and artwork collection for a closer look at GTA VI. Rockstar’s media page is the place to find the original images.', $mediaSource],
        ];

        foreach ($stories as $index => [$slug, $title, $topic, $image, $intro, $source]) {
            $existing = Post::where('slug', $slug)->first();
            if ($existing && ! ($existing->external_data['preview_content'] ?? false)) {
                continue;
            }

            $tag = Tag::firstOrCreate(['slug' => \Str::slug($topic)], ['name' => $topic]);
            $post = Post::firstOrCreate(['slug' => $slug], [
                'slug' => $slug, 'title' => $title, 'meta_title' => $title.' | GTA VI News',
                'meta_description' => \Str::limit($intro, 155), 'intro' => $intro,
                'category_id' => $category->id, 'author_id' => $author->id,
                'status' => PostStatus::PUBLISHED, 'tc_style' => PostTCStyle::R_SIDEBAR,
                'published_at' => now()->subHours($index * 3),
                'external_data' => ['source' => $source, 'preview_content' => true],
            ]);
            $post->tags()->syncWithoutDetaching([$tag->id]);
            $assetPath = public_path('images/gta-vi/'.$image);
            Storage::disk('aimages')->put('gta-vi-'.$image, file_get_contents($assetPath));
            $attachment = Attachment::firstOrCreate(['name' => 'gta-vi-'.$image, 'type' => 'image'], [
                'original_name' => $image, 'alt' => $title, 'title' => $title,
                'size' => filesize($assetPath), 'source' => $source,
            ]);
            if (! $post->thumbnail()) {
                $post->addAttachment(['id' => $attachment->id], 'thumbnail');
            }
            $block = $post->blocks()->firstOrCreate(['ident' => 'the-dispatch'], ['name' => 'The dispatch', 'order' => 1]);
            $block->items()->updateOrCreate(['order' => 1], ['type' => 'text', 'value' => json_encode(['value' => '<p>'.e($intro).'</p><p>Take a closer look at <a href="'.e($source).'" target="_blank" rel="noopener">Rockstar’s official GTA VI website</a>.</p><p><em>This is a starter article for the local design preview.</em></p>'])]);
        }

        cache()->flush();
    }
}
