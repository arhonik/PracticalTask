<?php

namespace App;

class ReportReader
{
    private string $fullPathToReport;
    private mixed $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new \App\Report($fullPathToReport);
    }

    public function readReportHeader(): \App\ReportHeader
    {
        $this->report->goToHeadersReport();
        return $this->createReportHeader();
    }

    public function readReportRecord(): \App\ReportRecord|bool
    {
        $this->report->goToBodyReport();
        return $this->createReportRecord();
    }

    public function readChunkReport($numberOfLines): array|bool
    {
        $this->report->goToBodyReport();
        return $this->createArrayReportRecord($numberOfLines);
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
        if ($this->report->isNotEndingFile()) {
            $emptyReportRecord = new \App\ReportRecord();
            return $this->filingInObjectFromReportLine($emptyReportRecord);
        } else {
            return false;
        }
    }

    private function filingInObjectFromReportLine($object): mixed
    {
        $data = $this->report->getLneReport();
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }
}