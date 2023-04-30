<?php

use Jfmonteiro252\ThewisepadPhpApi\entity\Email;
use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidEmailError;

final class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function testCostructorInvalidEmail()
    {
        $email = Email::create('swim-printed-21@inboxkitten');
        $this->assertTrue($email->isLeft());

        $email->left(function ($e) {
            $this->assertTrue($e instanceof InvalidEmailError);
        });
    }

    public function testConstructorValidEmail()
    {
        $email = Email::create('swim-printed-21@inboxkitten.com');
        $this->assertTrue($email->isRight());

        $email->right(function ($e) {
            $this->assertSame('swim-printed-21@inboxkitten.com', $e->getValue());
        });
    }
}
