<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files\Exceptions;

use RuntimeException;
use Throwable;

class UnableToOpenFileException extends RuntimeException
{
    public function __construct(string $path = null, int $code = 0, Throwable $previous = null)
    {
        if ($path === null)
        {
            $message = 'Unable to open file.';
        }
        else
        {
            $message = sprintf('Unable to open file "%s".', $path);
        }

        parent::__construct($message, $code, $previous);
    }
}
