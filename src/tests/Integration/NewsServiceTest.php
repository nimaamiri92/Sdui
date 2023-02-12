<?php

namespace Tests\Integration;

use App\Models\News;
use App\Models\User;
use App\Service\NewsService;
use App\ValueObjects\NewsValueObject;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class NewsServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_news_service()
    {
        $user            =
            User::factory()
                ->create();
        $newsValueObject = Mockery::mock(NewsValueObject::class);
        $newsValueObject->shouldReceive('toArray')
            ->andReturn(['title' => 'test', 'content' => 'content']);

        (new NewsService($user))->saveNews($newsValueObject);

        $this->assertDatabaseCount('news', 1);
    }

    public function test_update_news_service()
    {
        $user =
            User::factory()
                ->create();
        $news =
            News::factory()
                ->create();

        $newsValueObject = Mockery::mock(NewsValueObject::class);
        $newsValueObject->shouldReceive('getTitle')->andReturn('test');
        $newsValueObject->shouldReceive('getContent')->andReturn('content');

        $result = (new NewsService($user))->updateNews($newsValueObject, $news);

        $databaseResult = News::query()->where(['id' => $result->id])->first();

        $this->assertEquals($result->title,$databaseResult->title);
    }
}