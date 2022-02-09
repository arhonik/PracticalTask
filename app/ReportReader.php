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

    public function readReportHeader(): \App\ReportHeader
    {
        $this->goToHeadersReport();

        return $this->createReportHeader();
    }

    public function readReportRecord(): \App\ReportRecord
    {
        $this->goToBodyReport();

        return $this->createReportRecord();
    }

    public function readReportChank($numberOfLines): array
    {
        $this->goToBodyReport();

        return $this->createArrayReportRecord($numberOfLines);
    }

    private function goToBodyReport()
    {
        if ($this->isBeginningFile()) {
            fgetcsv($this->report, 0, ';');
        }
    }

    private function isBeginningFile(): bool
    {
        if (ftell($this->report) == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function goToHeadersReport()
    {
        rewind($this->report);
    }

    private function createArrayReportRecord($numberOfLines): array
    {
        $arrayReportRecord = array();
        for ($i = 0; $i < $numberOfLines; $i++) {
            $reportRecord = $this->createReportRecord();
            $arrayReportRecord[] = $reportRecord;
        }

        return $arrayReportRecord;
    }

    private function createReportHeader(): \App\ReportHeader
    {
        $emptyReportHeader = new \App\ReportHeader();

        return $this->filingInObjectFromReportLine($emptyReportHeader);
    }

    private function createReportRecord(): \App\ReportRecord
    {
        $emptyReportRecord = new \App\ReportRecord();
        
        return $this->filingInObjectFromReportLine($emptyReportRecord);
    }

    private function filingInObjectFromReportLine($object): mixed
    {
        $data = fgetcsv($this->report, 0, ';');
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    public function __destruct()
    {
        fclose($this->report);
    }
}
