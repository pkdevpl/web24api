<?php

namespace App\Exception;

use Exception;

class NotFoundException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}