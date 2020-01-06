<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files;

use Alzundaz\Files\Exceptions\FileNotFoundException;
use Alzundaz\Files\Exceptions\FileModeInvalidException;
use Alzundaz\Files\Exceptions\UnableToOpenFileException;
use LogicException;

class FileObject
{
    private string $path;
    private int $mode;
    private $fd;

    private static $table = [
        FO::READ | FO::START => 'r',
        FO::READ | FO::WRITE | FO::START => 'r+',
        FO::WRITE | FO::CREATE | FO::TRUNCATE | FO::START => 'w',
        FO::READ | FO::WRITE | FO::CREATE | FO::TRUNCATE | FO::START => 'w+',
        FO::WRITE | FO::CREATE | FO::END => 'a',
        FO::READ | FO::WRITE | FO::CREATE | FO::END => 'a+',
        FO::WRITE | FO::CREATE | FO::EXCLUSIVE | FO::START => 'x',
        FO::READ | FO::WRITE | FO::CREATE | FO::EXCLUSIVE | FO::START => 'x+',
        FO::WRITE | FO::CREATE | FO::START => 'c',
        FO::READ | FO::WRITE | FO::CREATE | FO::START => 'c+',
    ];

    public function __construct(string $path, int $mode = FO::READ | FO::START)
    {
        $this->path = $path;
        $this->mode = $mode;

        if (!$this->hasMode(FO::START) && !$this->hasMode(FO::END))
        {
            $this->mode |= FO::START;
        }

        if (is_dir($this->path))
        {
            throw new LogicException(sprintf('"%s" is a directory.', $this->path));
        }

        if (!file_exists($this->path) && !$this->hasMode(FO::CREATE))
        {
            throw new FileNotFoundException($this->path);
        }

        if (!key_exists($this->mode, self::$table))
        {
            throw new FileModeInvalidException($this->mode);
        }

        $this->fd = @fopen($this->path, self::$table[$this->mode]);

        if (!is_resource($this->fd))
        {
            throw new UnableToOpenFileException($this->path);
        }
    }

    public function __destruct()
    {
        $this->unlock();
        fclose($this->fd);
    }

    public function hasMode(int $mode): bool
    {
        return (($this->mode & $mode) == $mode);
    }

    public function lock(int $operation): bool
    {
        return flock($this->fd, $operation);
    }

    public function unlock(): bool
    {
        return flock($this->fd, LOCK_UN);
    }
}
