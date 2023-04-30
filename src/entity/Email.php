<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidEmailError;
use PhpSlang\Either\Either;
use PhpSlang\Either\Left;
use PhpSlang\Either\Right;

class Email
{
    private $value;

    private function __construct($email)
    {
        $this->value = $email;
    }

    public static function create($email): Either
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new Left(new InvalidEmailError($email));
        }

        return new Right(new Email($email));
    }

    public function getValue()
    {
        return $this->value;
    }
}
