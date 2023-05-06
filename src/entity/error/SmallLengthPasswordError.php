<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity\error;

class SmallLengthPasswordError
{
    private string $value;

    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
