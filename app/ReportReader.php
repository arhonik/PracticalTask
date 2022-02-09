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

    public function readReportRecord(): \App\ReportRecord|bool
    {
        $this->goToBodyReport();
        if ($this->isNotEndingFile()) {
            return $this->createReportRecord();
        } else {
            return false;
        }
    }

    public function readReportChank($numberOfLines): array|bool
    {
        $this->goToBodyReport();
        if ($this->isNotEndingFile()) {
            return $this->createArrayReportRecord($numberOfLines);
        } else {
            return false;
        }
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

    private function isNotEndingFile(): bool
    {
        if (feof($this->report)) {
            return false;
        } else {
            return true;
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
            if ($reportRecord) {
                $arrayReportRecord[] = $reportRecord;
            }
        }

        return $arrayReportRecord;
    }

    private function createReportHeader(): \App\ReportHeader
    {
        $emptyReportHeader = new \App\ReportHeader();
        return $this->filingInObjectFromReportLine($emptyReportHeader);
    }

    private function createReportRecord(): \App\ReportRecord|bool
    {
        if ($this->isNotEndingFile()) {
            $emptyReportRecord = new \App\ReportRecord();
            return $this->filingInObjectFromReportLine($emptyReportRecord);
        } else {
            return false;
        }
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