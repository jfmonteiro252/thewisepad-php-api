<?php

namespace Jfmonteiro252\ThewisepadPhpApi\entity;

use PhpSlang\Either\Either;
use PhpSlang\Either\Right;

class User
{
    private Email $email;
    private Password $password;

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(string $email, string $password): Either
    {
        $emailOrError = Email::create($email);
        if ($emailOrError->isLeft()) {
            return $emailOrError;
        }

        $passwordOrError = Password::create($password);
        if ($passwordOrError->isLeft()) {
            return $passwordOrError;
        }

        $emailObject = $emailOrError->get();
        $passwordObject = $passwordOrError->get();

        return new Right(new User($emailObject, $passwordObject));
    }
}
