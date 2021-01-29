<?php

namespace App\Library;

class LocateClass{
    public static function regex_address($id, $address){
        $split_address = explode(' ', $address);
        preg_match( '/(.*(?:都|道|府|県))(.*(?:市|区|郡))/', $split_address[1], $matches );
        return $matches;
    }
}