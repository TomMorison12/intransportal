<?php

namespace App;


Class Spam {
    /** *
     * @param $body
     * @return bool
     * @throws \Exception
     */
    public function detect($body) {


            $this->detectInvalidKeywords($body);

        return false;
    }

    /** *
     * @param $body
     * @throws \Exception
     */
    public function detectInvalidKeywords($body) {


        $invalids = [
            'yahoo customer support',

        ];

        foreach($invalids as $keyword) {

            if(stripos($body, $keyword) !== false) {

                throw new \Exception('Your reply contains spam');
            }
        }

    }
}
