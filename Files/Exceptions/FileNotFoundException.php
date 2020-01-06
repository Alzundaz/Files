<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files\Exceptions;

use RuntimeException;
use Throwable;

class FileNotFoundException extends RuntimeException
{
    public function __construct(string $path = null, int $code = 0, Throwable $previous = null)
    {
        if ($path === null)
        {
            $message = 'File could not be found.';
        }
        else
        {
            $message = sprintf('File "%s" could not be found.', $path);
        }

        parent::__construct($message, $code, $previous);
    }
}
