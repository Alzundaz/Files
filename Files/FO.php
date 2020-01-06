<?php
/**
 * Simple file objects library.
 *
 * @license https://github.com/Alzundaz/Files/blob/master/LICENSE (MIT License)
 */

namespace Alzundaz\Files;

class FO
{
    const NONE = 0;
    const READ = 1;
    const WRITE = 2;
    const CREATE = 4;
    const EXCLUSIVE = 8;
    const TRUNCATE = 16;
    const START = 32;
    const END = 64;
}
