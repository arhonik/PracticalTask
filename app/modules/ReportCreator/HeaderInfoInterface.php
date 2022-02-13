<?php

namespace App\Modules\ReportCreator;

interface HeaderInfoInterface
{
    public function getName(): string;

    public function getPosition(): int;
}