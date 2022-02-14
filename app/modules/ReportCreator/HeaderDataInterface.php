<?php

namespace App\Modules\ReportCreator;

interface HeaderDataInterface
{
    public function getName(): string;

    public function getPosition(): int;
}