<?php

namespace App\Library;

class LocateClass{
    public static function regex_address($address){
        $regex = [
            "/(?:\S+\s)(\S+(?:都|道|府|県))(\S+(?:市|区|郡))(?:.*)/",
            "/(?:\S+\s)(\S+(?:市|区|郡))\s(\S*(?:都|道|府|県))/"
        ];

        preg_match($regex[0], $address, $matches );
        if(!$matches){
            preg_match($regex[1], $address, $matches );
            if($matches){
                $tmp = $matches[1];
                $matches[1] = $matches[2];
                $matches[2] = $tmp;
            }
        }
        return $matches;
    }
}