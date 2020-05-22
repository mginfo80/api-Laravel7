<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\User;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @return void
     */
    public function store_post()
    {
        $user = create('App\User');
        
        $data = [
            'title'     => $this->faker->sentence($ndWords = 6, $variableNbWords = true),
            'author_id' => $user->id,
            'content'   => $this->faker->text($maxNbChars = 40),
        ];


        $response = $this->json('POST', $this->baseUrl . "posts", $data);


        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $data);

        $post = Post::all()->first();

        $response->assertJson([
            'data'  => [
                'id'    => $post->id,
                'title' => $post->title
            ]
        ]);
    }

    /**
     * @test
     */
    public function updates_post(){


    $data = [
    'title' => $this->faker->sentence($ndWords = 6, $variableNbWords = true),
    'content' => $this->faker->text($maxNbChars = 40),
    ];

        create('App\User');
        $post = create('App\Models\Post');

        $this->json('PUT', $this->baseUrl."posts/{$post->id}", $data)
        ->assertStatus(200);

        $post = $post->fresh();

        $this->assertEquals($post->title, $data['title']);
        $this->assertEqueals($post->content, $data['content']);
    }


        public function shows_post()
    {
        create('App\User');
        $post = create('App\Models\Post');

        $response = $this->json('GET', $this->baseUrl. "posts/{$post->id}");
        $response->asserStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title
            ]
        ]);
    }
}
