<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidEmailError;
use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidPasswordError;
use Jfmonteiro252\ThewisepadPhpApi\entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testInvalidEmail(): void
    {
        $userOrError = User::create('swim-printed-21@inboxkitten', 'Z10N0101');
        $this->assertTrue($userOrError->isLeft());
        $errorObject = $userOrError->get();
        $this->assertTrue($errorObject instanceof InvalidEmailError);
    }

    public function testInvalidPassword(): void
    {
        $userOrError = User::create('swim-printed-21@inboxkitten.com', 'Z10N');
        $this->assertTrue($userOrError->isLeft());
        $errorObject = $userOrError->get();
        $this->assertTrue($errorObject instanceof InvalidPasswordError);
    }

    public function testValid(): void
    {
        $userOrError = User::create('swim-printed-21@inboxkitten.com', 'Z10N0101');
        $this->assertTrue($userOrError->isRight());
        $userObject = $userOrError->get();
        $this->assertSame(
            'swim-printed-21@inboxkitten.com',
            $userObject->getEmail()->getValue()
        );
        $this->assertSame('Z10N0101', $userObject->getPassword()->getValue());
    }
}
