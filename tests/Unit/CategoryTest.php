<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Category $category;

    protected function setUp(): void
    {
        parent::setUp();
    
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }
    
    public function testCategoryHaveSlug()
    {
        $this->assertSame(
            Str::slug($this->category->title),
            $this->category->slug
        );
    }
    
    public function testCategoryHavePosts()
    {        
        Post::factory()->count(4)->create([
            'category_slug' => $this->category->slug,
        ]);

        $this->assertCount(4, $this->category->posts);
    }
}
