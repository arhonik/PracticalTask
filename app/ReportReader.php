<?php

namespace App;

class ReportReader
{
    private string $fullPathToReport;
    
    public function __construct($fullPathToReport)
    {
        $this->fullPathToReport = $fullPathToReport;
    }

    public function readReportTitle(): array
    {
        $report = fopen($this->fullPathToReport, 'rt');
        $data = fgetcsv($report, 0, ';');
        return $data;
    }

    public function readReportRecord()
    {
        
    }

    public function readReporttChank()
    {
        
    }
}