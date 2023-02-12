<?php

namespace App\Service;

use App\Models\News;
use App\ValueObjects\NewsValueObject;
use Illuminate\Contracts\Auth\Authenticatable;

class NewsService
{
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    public function saveNews(NewsValueObject $newsValueObject): News
    {
        return $this
            ->user
            ->news()
            ->create($newsValueObject->toArray());
    }

    public function updateNews(NewsValueObject $newsValueObject, News $news): News
    {
        $news->title   = $newsValueObject->getTitle();
        $news->content = $newsValueObject->getContent();

        if ($news->isDirty()) {
            $news->save();
        }

        return $news;
    }
}