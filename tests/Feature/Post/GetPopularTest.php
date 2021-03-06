<?php

namespace Tests\Feature\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPopularTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/popular/';

    private User $user;
    private Category $category;
    private Provider $provider;
    private Collection $posts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->has(Provider::factory())
            ->create();
        $this->category = Category::factory()->create();
        $this->provider = $this->user->provider;
        $this->posts = Post::factory()
            ->count(10)
            ->sequence([
                'category_slug' => $this->category->slug,
                'provider_slug' => $this->provider->slug,
            ])
            ->has(PostLike::factory()->count(6), 'likes')
            ->create();

        $this->posts->each(
            fn($p) => PostLike::factory()
                ->count(4)
                ->create(['post_slug' => $p->slug]),
        );
    }

    public function testUserCanGetPopularPostsByCategorySlug()
    {
        $this->getJson(self::BASE_URI . $this->category->slug)
            ->assertOk()
            ->assertJsonCount(5)
            ->assertJsonFragment(['title' => $this->posts->first()->title]);
    }

    public function testUserCanGetPopularPostsByProviderSlug()
    {
        $this->getJson(self::BASE_URI . $this->provider->slug . '/provider')
            ->assertOk()
            ->assertJsonCount(5)
            ->assertJsonFragment(['title' => $this->posts->first()->title]);
    }

    public function testUserCanGetPopularPostsIfNoCategoryOrProvierWasRequested()
    {
        $this->getJson(self::BASE_URI)
            ->assertOk()
            ->assertJsonCount(5)
            ->assertJsonFragment(['title' => $this->posts->first()->title]);
    }
}
