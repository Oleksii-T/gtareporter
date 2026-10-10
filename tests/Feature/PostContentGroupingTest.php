<?php

namespace Tests\Feature;

use App\Models\ContentBlock;
use App\Models\Post;
use Tests\TestCase;

class PostContentGroupingTest extends TestCase
{
    public function test_articles_without_explicit_groups_keep_their_content(): void
    {
        $post = new Post;
        $first = new ContentBlock(['order' => 1]);
        $second = new ContentBlock(['order' => 2]);
        $post->setRelation('blocks', collect([$second, $first]));

        $groups = $post->getGroupedBlocks();

        $this->assertCount(1, $groups);
        $this->assertSame([$first, $second], $groups[0]->values()->all());
    }

    public function test_explicit_article_groups_are_preserved(): void
    {
        $post = new Post(['block_groups' => [1, 1]]);
        $first = new ContentBlock(['order' => 1]);
        $second = new ContentBlock(['order' => 2]);
        $post->setRelation('blocks', collect([$first, $second]));

        $groups = $post->getGroupedBlocks();

        $this->assertCount(2, $groups);
        $this->assertSame([$first], $groups[0]->values()->all());
        $this->assertSame([$second], $groups[1]->values()->all());
    }
}
