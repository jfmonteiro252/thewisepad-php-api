<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity\error;

class LargeLengthTitleError
{
    private string $value;

    public function __construct(string $title)
    {
        $this->value = $title;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
