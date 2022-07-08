<?php

namespace App\Traits;

trait Sanitize
{

    /**
     * Remove caracteres
     * */
    public function removeCharacters(&$data) {
        foreach ($data as $key => &$value) {
            if ($key != 'password' && $key != 'email' && $key != 'file' && $key != 'dateOne' &&  $key != 'dateOTwo' && $key != 'description') {
                $value = str_replace(['-','/','+','*','@','%','&','=','[',']','(',')','$', '#','!'],'', $value);
            }
        }
        return $data;
    }

}