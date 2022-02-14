<?php

namespace App\Modules\ReportCreator;

class ArrayAnalyzer
{
    public static function isArrayWithData(mixed $lineReport): bool
    {
        if (is_array($lineReport) && count($lineReport) > 0) {
            return true;
        } else {
            return false;
        }
    }
}