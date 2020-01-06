<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files\Exceptions;

use LogicException;
use Throwable;

class FileModeInvalidException extends LogicException
{
    public function __construct(int $mode = null, int $code = 0, Throwable $previous = null)
    {
        if ($mode === null)
        {
            $message = 'File mode is invalid.';
        }
        else
        {
            $message = sprintf('File mode "%d" is invalid.', $mode);
        }

        parent::__construct($message, $code, $previous);
    }
}
