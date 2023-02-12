<?php

namespace App\ValueObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class NewsValueObject implements Arrayable
{
    private string $title;

    private string $content;

    private function __construct(string $title, string $content)
    {
        $this->title   = $title;
        $this->content = $content;
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            $request->get('title'),
            $request->get('content'),
        );
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    public function toArray(): array
    {
        return [
            'title'   => $this->getTitle(),
            'content' => $this->getContent(),
        ];
    }
}