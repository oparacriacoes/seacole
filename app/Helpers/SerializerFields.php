<?php

namespace App\Helpers;

trait SerializerFields {
    public function serializerFields($keys, $array) {
        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $array[$key] = serialize($array[$key]);
            }
        }

        return $array;
    }
}
