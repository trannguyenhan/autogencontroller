<?php

namespace Trannguyenhan\AutogenController\helpers;

use Illuminate\Support\Str;

class Helpers
{
    public static function buildPath($namespace, $fileType): string
    {
        $fileType = ucfirst(Str::plural($fileType));
        if($namespace == "" || $namespace == null){
            return base_path() . "/app/Http/" . $fileType;
        }

        return base_path() . "/app/Http/" . $fileType . "/" . $namespace;
    }
}
