<?php

namespace Alzundaz\Files\Tests\Exceptions;

use Alzundaz\Files\Exceptions\UnableToOpenFileException;
use PHPUnit\Framework\TestCase;

class UnableToOpenFileExceptionTest extends TestCase
{
    public function testWithMessage()
    {
        $this->expectException(UnableToOpenFileException::class);
        $this->expectExceptionMessage('Unable to open file "1234".');

        throw new UnableToOpenFileException(1234);
    }

    public function testWithoutMessage()
    {
        $this->expectException(UnableToOpenFileException::class);
        $this->expectExceptionMessage('Unable to open file.');

        throw new UnableToOpenFileException();
    }
}
