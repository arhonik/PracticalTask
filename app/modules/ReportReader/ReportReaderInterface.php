<?php

namespace App\Modules\ReportReader;

interface ReportReaderInterface
{
    public function getReportHeader(): ?ReportLineInterface;

    public function getReportRecord(): ?ReportLineInterface;

    public function getReportChunk(int $numberOfLines): ?array;
}