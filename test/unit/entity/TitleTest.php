<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidTitleError;
use Jfmonteiro252\ThewisepadPhpApi\entity\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function testSmallLength(): void
    {
        $titleOrError = Title::create('MTW');
        $this->assertTrue($titleOrError->isLeft());
        $errorObject = $titleOrError->get();
        $this->assertTrue($errorObject instanceof InvalidTitleError);
    }

    public function testeLargeLength(): void
    {
        $titleOrError = Title::create(
            'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius'
                . ' voluptatibus itaque minima exercitationem, debitis'
                . ' consectetur eaque a ipsa quas corporis animi tempora'
                . ' maxime delectus laboriosam totam commodi, aut repudiandae'
                . ' obcaecati.'
        );
        $this->assertTrue($titleOrError->isLeft());
        $errorObject = $titleOrError->get();
        $this->assertTrue($errorObject instanceof InvalidTitleError);
    }

    public function testValid(): void
    {
        $titleOrError = Title::create('Movies to watch');
        $this->assertTrue($titleOrError->isRight());
        $titleObject = $titleOrError->get();
        $this->assertSame('Movies to watch', $titleObject->getValue());
    }
}
