<?php

namespace App\Modules\ReportCreator;

interface ReportInterface
{
    public function getHeader(): ?ReportRecordInterface;

    public function getRecord(): ?ReportRecordInterface;

    public function getChunk(int $numberOfRecords): ?array;
}