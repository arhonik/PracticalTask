<?php

namespace App\Modules\ReportReader;

interface ReportReaderInterface
{
    public function getReportHeader(): ReportHeader;

    public function getReportRecord(): ?ReportRecord;

    public function getReportChunk(int $numberOfLines): ?array;
}