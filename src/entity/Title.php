<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidTitleError;
use PhpSlang\Either\Either;
use PhpSlang\Either\Left;
use PhpSlang\Either\Right;

class Title
{
    private const LENGTH_MINIMUM = 4;
    private const LENGTH_MAXIMUM = 200;
    private string $value;

    private function __construct(string $title)
    {
        $this->value = $title;
    }

    public static function validateMininumLength(string $title): Either
    {
        if (strlen($title) < self::LENGTH_MINIMUM) {
            return new Left(new InvalidTitleError($title));
        };

        return new Right(true);
    }

    public static function validateMaximumLength(string $title): Either
    {
        if (strlen($title) > self::LENGTH_MAXIMUM) {
            return new Left(new InvalidTitleError($title));
        };

        return new Right(true);
    }

    public static function validate(string $title): Either
    {
        $validation = self::validateMininumLength($title);
        if ($validation->isLeft()) {
            return $validation;
        }

        $validation = self::validateMaximumLength($title);
        if ($validation->isLeft()) {
            return $validation;
        }

        return new Right(true);
    }

    public static function create(string $title): Either
    {
        $validation = self::validate($title);
        if ($validation->isLeft()) {
            return $validation;
        }

        return new Right(new Title($title));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
