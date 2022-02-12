<?php

namespace App\Modules\ReportCreator;

interface ReportInterface
{
    public function getHeader(): ?RecordInterface;

    public function getRecord(): ?RecordInterface;

    public function getChunk(int $numberOfRecords): ?array;
}