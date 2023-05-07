<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\Email;
use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidEmailError;

final class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function testCostructorInvalidEmail(): void
    {
        $emailOrError = Email::create('swim-printed-21@inboxkitten');
        $this->assertTrue($emailOrError->isLeft());
        $errorObject = $emailOrError->get();
        $this->assertTrue($errorObject instanceof InvalidEmailError);
    }

    public function testConstructorValidEmail(): void
    {
        $emailOrError = Email::create('swim-printed-21@inboxkitten.com');
        $this->assertTrue($emailOrError->isRight());
        $emailObject = $emailOrError->get();
        $this->assertSame('swim-printed-21@inboxkitten.com', $emailObject->getValue());
    }
}
