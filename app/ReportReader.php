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
        $report = fopen($this->fullPathToReport, 'rt');
        $data = fgetcsv($report, 0, ';');
        fclose($report);
        return $data;
    }

    public function readReportRecord(): array
    {
        $report = fopen($this->fullPathToReport, 'rt');
        $level = 0;
        while (($data = fgetcsv($report, 0, ";")) !== FALSE) {
            if ($level > 0) {
                return $data;
            }
            $level++;
        }
        fclose($report);
    }

    public function readReporttChank()
    {

    }
}