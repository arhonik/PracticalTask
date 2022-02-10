<?php

namespace App;

interface ReportReaderInterface
{
    public function getReportHeader(): ReportHeader;

    public function getReportRecord(): ReportRecord|bool;

    public function getReportChunk(int $numberOfLines): array;
}