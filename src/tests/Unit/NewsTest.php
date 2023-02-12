<?php

namespace Tests\Unit;

use App\Http\Requests\V1\NewsRequest;
use App\ValueObjects\NewsValueObject;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function test_to_array_in_news_value_object()
    {
        $dumpData = ['title' => 'title', 'content' => 'content'];
        $request = new NewsRequest([], $dumpData);

        $valueObject = NewsValueObject::fromRequest($request);

        $this->assertEquals($dumpData,$valueObject->toArray());
    }
}