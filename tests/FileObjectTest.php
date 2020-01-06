<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files\Tests;

use Alzundaz\Files\Exceptions\FileModeInvalidException;
use Alzundaz\Files\Exceptions\FileNotFoundException;
use Alzundaz\Files\Exceptions\UnableToOpenFileException;
use Alzundaz\Files\FileObject;
use Alzundaz\Files\FO;
use LogicException;
use PHPUnit\Framework\TestCase;

class FileObjectTest extends TestCase
{
    public function testOpenDirectory()
    {
        $this->expectException(LogicException::class);
        new FileObject('.');
    }

    public function testOpenInexistantFile()
    {
        $this->expectException(FileNotFoundException::class);
        new FileObject('nofile');
    }

    public function testInvalidMode()
    {
        $this->expectException(FileModeInvalidException::class);
        $this->expectExceptionMessage('File mode "32" is invalid.');
        new FileObject('./tests/samples/void', FO::NONE);
    }

    public function testOpenFile()
    {
        $fileObject = new FileObject('./tests/samples/void');
        $this->assertInstanceOf('\Alzundaz\Files\FileObject', $fileObject);
    }

    public function testUnableToOpenFile()
    {
        $this->expectException(UnableToOpenFileException::class);
        new FileObject('./tests/samples/void', FO::WRITE | FO::CREATE | FO::EXCLUSIVE);
    }

    public function testLockFile()
    {
        $fileObject = new FileObject('./tests/samples/void');
        $otherFileObject = new FileObject('./tests/samples/void');
        $this->assertTrue($fileObject->lock(LOCK_EX | LOCK_NB));
        $this->assertFalse($otherFileObject->lock(LOCK_EX | LOCK_NB));
    }
}
