<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity\error;

class InvalidEmailError
{
    private string $value;

    public function __construct(string $email)
    {
        $this->value = $email;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
