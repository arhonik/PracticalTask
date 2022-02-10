<?php

namespace App\Modules\ReportReader;

interface ReportLineInterface
{
    public function __set($name, $value);

    public function __get($name);

    public function __isset($name);

    public function __unset($name);
}