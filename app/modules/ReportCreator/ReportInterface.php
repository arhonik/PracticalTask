<?php

namespace App\Modules\ReportCreator;

interface ReportInterface
{
    public function getHeader(): ?ReportLineInterface;

    public function getRecord(): ?ReportLineInterface;

    public function getChunk(int $numberOfLines): ?array;
}