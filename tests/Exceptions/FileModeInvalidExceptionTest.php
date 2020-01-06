<?php

namespace Alzundaz\Files\Tests\Exceptions;

use Alzundaz\Files\Exceptions\FileModeInvalidException;
use PHPUnit\Framework\TestCase;

class FileModeInvalidExceptionTest extends TestCase
{
    public function testWithMessage()
    {
        $this->expectException(FileModeInvalidException::class);
        $this->expectExceptionMessage('File mode "1234" is invalid.');

        throw new FileModeInvalidException(1234);
    }

    public function testWithoutMessage()
    {
        $this->expectException(FileModeInvalidException::class);
        $this->expectExceptionMessage('File mode is invalid.');

        throw new FileModeInvalidException();
    }
}
