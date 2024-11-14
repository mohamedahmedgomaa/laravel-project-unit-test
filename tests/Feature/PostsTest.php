<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase; // delete rows in database and add row and delete row
//    use DatabaseTruncation; // refresh database and delete database and add database and add row
//    use DatabaseMigrations; // refresh database and delete database and add database and add row and delete row

    /**
     * A basic feature test example.
     */
    public function test_visit_empty_posts_page(): void
    {
        $user = User::factory()->create();

        // Log in the user
//        $this->actingAs($user);
//        $response = $this->get('posts');
        // or
        $response = $this->actingAs($user)->get('posts');

        $response->assertSee("No Data");
        $response->assertStatus(200);
    }

    public function test_visit_not_empty_posts_page(): void
    {
        $user = User::factory()->create();
        $post = Post::factory(20)->create(['user_id' => $user->id]);


        // Log in the user
//        $this->actingAs($user);
//        $response = $this->get('posts');
        // or
        $response = $this->actingAs($user)->get('posts');

        if ($response->status() == 200) {
            $response->assertViewHas("posts", function ($posts) use ($post) {
                return $posts->contains($post->last());
            });
        }
    }

    public function test_add_new_post(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title' => 'Test title',
        ]);
        // assertSessionHasErrors
        // assertSessionHasNoErrors
        // assertSessionDoesntHaveErrors
        if ($response->assertSessionHasNoErrors()) {
            $response->assertRedirect(route('posts.index'));
        }
    }

    //        $response->assertStatus(200);
//        $response->assertOk(); // 200
//        $response->assertAccepted(); // 202
//        $response->assertNotFound(); // 404
//        $response->status(); // get current status
//        $response->statusText(); // Text Status Like Ok Or BadRequest

}
