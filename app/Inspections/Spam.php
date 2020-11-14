<?php

namespace App\Inspections;

class Spam
{
    /** *
     * @param $body
     * @return bool
     * @throws \Exception
     */
    protected $inspections = [
            InvalidKeywords::class,
            KeyHeldDown::class,
        ];

    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }
    }
}
