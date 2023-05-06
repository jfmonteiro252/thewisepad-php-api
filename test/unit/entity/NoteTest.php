<?php

namespace Jfmonteiro252\ThewisepadPhpApi\test\unit\entity;

use Jfmonteiro252\ThewisepadPhpApi\entity\error\InvalidTitleError;
use Jfmonteiro252\ThewisepadPhpApi\entity\Note;
use Monolog\Test\TestCase;

class NoteTest extends TestCase
{
    public function testInvalidTitle(): void
    {
        $noteOrError = Note::create(
            'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eius'
                . ' voluptatibus itaque minima exercitationem, debitis'
                . ' consectetur eaque a ipsa quas corporis animi tempora'
                . ' maxime delectus laboriosam totam commodi, aut repudiandae'
                . ' obcaecati.'
        );
        $this->assertTrue($noteOrError->isLeft());
        $errorObject = $noteOrError->get();
        $this->assertTrue($errorObject instanceof InvalidTitleError);
    }

    public function testValid(): void
    {
        $noteOrError = Note::create('Movies to watch');
        $this->assertTrue($noteOrError->isRIght());
        $noteObject = $noteOrError->get();
        $this->assertSame('Movies to watch', $noteObject->getTitle()->getValue());
    }
}
