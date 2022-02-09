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
        rewind($this->report);
        return fgetcsv($this->report, 0, ';');
    }

    public function readReportRecord(): array|bool
    {
        if (ftell($this->report) == 0){
            fgetcsv($this->report, 0, ';');
        }
        return fgetcsv($this->report, 0, ';');
    }

    public function readReportChank($numberOfLines)
    {
        if (ftell($this->report) == 0){
            fgetcsv($this->report, 0, ';');
        }
        $arrayReportRecord = array();
        for ($i = 0; $i < $numberOfLines; $i++) {
            $arrayReportRecord[] = fgetcsv($this->report, 0, ';');
        }

        return $arrayReportRecord;
    }

    public function __destruct()
    {
        fclose($this->report);
    }
}