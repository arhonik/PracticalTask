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

    public function readReportHeader(): \App\ReportRecord
    {
        $this->jumpToTheBeginningOfTheFile();

        $reportRecord = $this->createReportRecord();

        return $reportRecord;
    }

    public function readReportRecord(): \App\ReportRecord
    {
        $this->checkingForTheBeginningOfFile();

        $reportRecord = $this->createReportRecord();

        return $reportRecord;
    }

    public function readReportChank($numberOfLines): array
    {
        $this->checkingForTheBeginningOfFile();

        $arrayReportRecord = array();
        for ($i = 0; $i < $numberOfLines; $i++) {
            $reportRecord = $this->createReportRecord();
            $arrayReportRecord[] = $reportRecord;
        }

        return $arrayReportRecord;
    }

    private function checkingForTheBeginningOfFile()
    {
        if (ftell($this->report) == 0){
            fgetcsv($this->report, 0, ';');
        }
    }

    private function jumpToTheBeginningOfTheFile()
    {
        rewind($this->report);
    }

    private function createReportRecord(): \App\ReportRecord
    {
        $reportRecord = new \App\ReportRecord();
        $data = fgetcsv($this->report, 0, ';');
        foreach ($data as $key => $value) {
            $reportRecord->$key = $value;
        }

        return $reportRecord;
    }

    public function __destruct()
    {
        fclose($this->report);
    }
}
