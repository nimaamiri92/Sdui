<?php

namespace App\Repositories\V1;


use App\Models\News;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class NewsRepository extends BaseRepository implements RepositoryInterface
{
    public function __construct(News $news)
    {
        parent::__construct($news);
    }

    public function findAll():Collection
    {
        return $this->model->get();
    }

    public function findOne(int $id): Model
    {
        return $this
            ->model
            ->where(['id' => $id])
            ->first();
    }
}