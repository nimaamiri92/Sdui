<?php

namespace App\Http\Controllers\V1;

use App\Events\NewsCreatedEvent;
use App\Http\Controllers\BaseController;
use App\Http\Requests\V1\NewsRequest;
use App\Http\Resources\V1\NewsCollection;
use App\Http\Resources\V1\NewsResource;
use App\Models\News;
use App\Repositories\V1\NewsRepository;
use App\Service\NewsService;
use App\ValueObjects\NewsValueObject;
use Illuminate\Http\Response;

class NewsController extends BaseController
{
    private NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        return new NewsCollection(
            $this->newsRepository->findAll()
        );
    }

    public function store(NewsRequest $request, NewsService $newsService)
    {
        $request->validated();

        $result = NewsResource::make(
            $newsService->saveNews(
                NewsValueObject::fromRequest($request)
            )
        );

        event(new NewsCreatedEvent);

        return $result;
    }

    public function show(News $news)
    {
        return NewsResource::make(
            $this->newsRepository->findOne($news->id)
        );
    }

    public function update(NewsRequest $newsRequest, NewsService $newsService, News $news)
    {
        $newsRequest->validated();

        return NewsResource::make(
            $newsService->updateNews(
                NewsValueObject::fromRequest($newsRequest),
                $news
            )
        );
    }

    public function destroy(News $news)
    {
        $news->delete();

        return $this->successResponse([], Response::HTTP_NO_CONTENT);
    }
}
