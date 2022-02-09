<?php

namespace App;

class ReportReader
{
    private string $fullPathToReport;
    private mixed $report;

    public function __construct($fullPathToReport)
    {
        $this->fullPathToReport = $fullPathToReport;
        $this->report = fopen($this->fullPathToReport, 'rt');
    }

    public function readReportTitle(): array
    {
        return fgetcsv($this->report, 0, ';');
    }

    public function readReportRecord(): array|bool
    {
        while (($data = fgetcsv($this->report, 0, ";")) !== FALSE) {
                return $data;
        }
    }

    public function readReporttChank()
    {

    }
}