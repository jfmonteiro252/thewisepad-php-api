<?php

use Jfmonteiro252\ThewisepadPhpApi\entity\error\LargeLengthTitleError;
use Jfmonteiro252\ThewisepadPhpApi\entity\error\SmallLengthTitleError;
use Jfmonteiro252\ThewisepadPhpApi\entity\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function testSmallLength(): void
    {
        $title = Title::create('MTW');
        $this->assertTrue($title->isLeft());

        $title->left(function ($e) {
            $this->assertTrue($e instanceof SmallLengthTitleError);
        });
    }

    public function testeLargeLength(): void
    {
        $title = Title::create(
            'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius'
                . ' voluptatibus itaque minima exercitationem, debitis'
                . ' consectetur eaque a ipsa quas corporis animi tempora'
                . ' maxime delectus laboriosam totam commodi, aut repudiandae'
                . ' obcaecati.'
        );
        $this->assertTrue($title->isLeft());

        $title->left(function ($e) {
            $this->assertTrue($e instanceof LargeLengthTitleError);
        });
    }

    public function testValid()
    {
        $title = Title::create('Movies to watch');
        $this->assertTrue($title->isRight());

        $title->right(function ($e) {
            $this->assertSame('Movies to watch', $e->getValue());
        });
    }
}
