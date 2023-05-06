<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidPasswordError;
use PhpSlang\Either\Either;
use PhpSlang\Either\Left;
use PhpSlang\Either\Right;

class Password
{
    private string $value;

    private function __construct(string $password)
    {
        $this->value = $password;
    }

    public static function validateContainsNumber(string $password): Either
    {
        if (!preg_match('/\d/', $password)) {
            return new Left(new InvalidPasswordError($password));
        };

        return new Right(true);
    }

    public static function validateMininumLength(string $password): Either
    {
        if (strlen($password) < 6) {
            return new Left(new InvalidPasswordError($password));
        };

        return new Right(true);
    }

    public static function validate(string $password): Either
    {
        $validation = self::validateContainsNumber($password);
        if ($validation->isLeft()) {
            return $validation;
        }

        $validation = self::validateMininumLength($password);
        if ($validation->isLeft()) {
            return $validation;
        }

        return new Right(true);
    }

    public static function create(string $password): Either
    {
        $validation = self::validate($password);
        if ($validation->isLeft()) {
            return $validation;
        }

        return new Right(new Password($password));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
