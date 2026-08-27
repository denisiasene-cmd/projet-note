<?php
namespace App\Core;
class debug {
    private function __construct(){

    }
    public static function debug(mixed $datas){
        echo '<pre>';
        var_dump($datas);
        echo '</pre>';
        die;
    }
}