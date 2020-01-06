<?php

namespace Alzundaz\Files\Tests\Exceptions;

use Alzundaz\Files\Exceptions\FileNotFoundException;
use PHPUnit\Framework\TestCase;

class FileNotFoundExceptionTest extends TestCase
{
    public function testWithMessage()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('File "1234" could not be found.');

        throw new FileNotFoundException(1234);
    }

    public function testWithoutMessage()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('File could not be found.');

        throw new FileNotFoundException();
    }
}
