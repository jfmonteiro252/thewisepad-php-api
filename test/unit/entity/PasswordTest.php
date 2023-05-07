<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidPasswordError;
use Jfmonteiro252\ThewisepadPhpApi\entity\Password;
use PHPUnit\Framework\TestCase;

final class PasswordTest extends TestCase
{
    public function testNoNumber(): void
    {
        $passwordOrError = Password::create('ZIONOIOI');
        $this->assertTrue($passwordOrError->isLeft());
        $errorObject = $passwordOrError->get();
        $this->assertTrue($errorObject instanceof InvalidPasswordError);
    }

    public function testSmallLength(): void
    {
        $passwordOrError = Password::create('Z10N');
        $this->assertTrue($passwordOrError->isLeft());
        $errorObject = $passwordOrError->get();
        $this->assertTrue($errorObject instanceof InvalidPasswordError);
    }

    public function testValid(): void
    {
        $passwordOrError = Password::create('Z10N0101');
        $this->assertTrue($passwordOrError->isRight());
        $passwordObject = $passwordOrError->get();
        $this->assertSame('Z10N0101', $passwordObject->getValue());
    }
}
