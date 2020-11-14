<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $invalids = [
        'yahoo customer support',

    ];

    public function detect($body)
    {
        foreach ($this->invalids as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam');
            }
        }
    }
}
