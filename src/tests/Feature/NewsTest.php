<?php

namespace Tests\Feature;

use App\Events\NewsCreatedEvent;
use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_news()
    {
        Event::fake();

        $title   = '::dummy_title::';
        $content = '::dummy_content::';
        $user    =
            User::factory()
                ->create();

        $response = $this
            ->actingAs($user, 'api')
            ->post(
                'api/news',
                compact('title', 'content'),
                ['accept' => 'application/json']
            );

        Event::assertDispatched(NewsCreatedEvent::class, 1);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'content',
                'author',
                'created_at',
            ],
        ]);
    }

    public function test_user_can_see_list_of_news()
    {
        $user =
            User::factory()
                ->create();

        $response = $this
            ->actingAs($user, 'api')
            ->get(
                'api/news',
                ['accept' => 'application/json']
            );
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'author',
                    'created_at',
                ],
            ],
        ]);
    }

    public function test_user_can_see_a_news()
    {
        $user =
            User::factory()
                ->create();
        $news =
            News::factory()
                ->create();

        $response = $this
            ->actingAs($user, 'api')
            ->get(
                'api/news/' . $news->id,
                ['accept' => 'application/json']
            );
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'content',
                'author',
                'created_at',
            ],
        ]);
    }

    public function test_user_can_update_a_news()
    {
        $title   = '::dummy_title::';
        $content = '::dummy_content::';

        $user =
            User::factory()
                ->create();
        $news =
            News::factory()
                ->create();

        $response = $this
            ->actingAs($user, 'api')
            ->put(
                'api/news/' . $news->id,
                compact('title', 'content'),
                ['accept' => 'application/json']
            );

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'content',
                'author',
                'created_at',
            ],
        ]);

        $parsedResponse = json_decode($response->getContent());

        $this->assertEquals($title, $parsedResponse->data->title);
        $this->assertEquals($content, $parsedResponse->data->content);
    }

    public function test_user_can_delete_a_news()
    {
        $user =
            User::factory()
                ->create();
        $news =
            News::factory()
                ->create();

        $response = $this
            ->actingAs($user, 'api')
            ->delete(
                'api/news/' . $news->id,
                ['accept' => 'application/json']
            );

        $response->assertStatus(204);
    }
}
