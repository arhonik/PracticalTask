<?php

namespace App;

interface ReportReaderInterface
{
    public function getReportHeader(): \App\ReportLineInterface;

    public function getReportRecord(): \App\ReportLineInterface|bool;

    public function getReportChunk(int $numberOfLines): array|bool;
}