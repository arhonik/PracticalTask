<?php

namespace App\Modules\ReportCreator;

interface ReportInterface
{
    public function getHeaders(): ?ColumnHeaders;

    public function getRecord(): ?RecordInterface;

    public function getChunk(int $numberOfRecords): ?array;
}