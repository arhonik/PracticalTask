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

    public function readReportTitle(): \App\ReportRecord
    {
        rewind($this->report);

        $reportRecord = new \App\ReportRecord();
        $data = fgetcsv($this->report, 0, ';');
        foreach ($data as $key => $value) {
            $reportRecord->$key = $value;
        }

        return $reportRecord;
    }

    public function readReportRecord(): \App\ReportRecord
    {
        if (ftell($this->report) == 0){
            fgetcsv($this->report, 0, ';');
        }

        $reportRecord = new \App\ReportRecord();
        $data = fgetcsv($this->report, 0, ';');
        foreach ($data as $key => $value) {
            $reportRecord->$key = $value;
        }

        return $reportRecord;
    }

    public function readReportChank($numberOfLines): array
    {
        if (ftell($this->report) == 0){
            fgetcsv($this->report, 0, ';');
        }

        $arrayReportRecord = array();
        for ($i = 0; $i < $numberOfLines; $i++) {
            $reportRecord = new \App\ReportRecord();
            $data = fgetcsv($this->report, 0, ';');
            foreach ($data as $key => $value) {
                $reportRecord->$key = $value;
            }

            $arrayReportRecord[] = $reportRecord;
        }

        return $arrayReportRecord;
    }

    public function __destruct()
    {
        fclose($this->report);
    }
}