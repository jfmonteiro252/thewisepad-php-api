<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity;

use PhpSlang\Either\Either;
use PhpSlang\Either\Right;

class Note
{
    private Title $title;

    public function getTitle(): Title
    {
        return $this->title;
    }

    private function __construct(Title $title)
    {
        $this->title = $title;
    }

    public static function create(string $title): Either
    {
        $titleOrError = Title::create($title);
        if ($titleOrError->isLeft()) {
            return $titleOrError;
        }

        $titleObject = $titleOrError->get();
        return new Right(new Note($titleObject));
    }
}
