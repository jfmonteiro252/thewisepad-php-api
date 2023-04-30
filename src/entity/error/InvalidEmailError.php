<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity\error;

class InvalidEmailError
{
    private $value;

    public function __construct($email)
    {
        $this->value = $email;
    }
}
