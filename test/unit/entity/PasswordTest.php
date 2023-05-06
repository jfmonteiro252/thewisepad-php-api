<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\NoNumberPasswordError;
use Jfmonteiro252\ThewisepadPhpApi\entity\error\SmallLengthPasswordError;
use Jfmonteiro252\ThewisepadPhpApi\entity\Password;
use PHPUnit\Framework\TestCase;

final class PasswordTest extends TestCase
{
    public function testNoNumber(): void
    {
        $password = Password::create('ZIONOIOI');
        $this->assertTrue($password->isLeft());

        $password->left(function ($e) {
            $this->assertTrue($e instanceof NoNumberPasswordError);
        });
    }

    public function testSmallLength(): void
    {
        $password = Password::create('Z10N');
        $this->assertTrue($password->isLeft());

        $password->left(function ($e) {
            $this->assertTrue($e instanceof SmallLengthPasswordError);
        });
    }

    public function testValid(): void
    {
        $password = Password::create('Z10N0101');
        $this->assertTrue($password->isRight());

        $password->right(function ($e) {
            $this->assertSame('Z10N0101', $e->getValue());
        });
    }
}
