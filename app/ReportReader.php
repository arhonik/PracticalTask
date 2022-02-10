<?php

namespace App;

class ReportReader
{
    private \App\Report $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new \App\Report($fullPathToReport);
    }

    public function getReportHeader(): \App\ReportHeader
    {
        $this->report->goToReportHeaders();
        return $this->createReportHeader();
    }

    public function getReportRecord(): \App\ReportRecord|bool
    {
        $this->report->ifNeedGoToBodyFromHeaderReport();
        return $this->createReportRecord();
    }

    public function getReportChunk(int $numberOfLines): array|bool
    {
        $this->report->ifNeedGoToBodyFromHeaderReport();
        return $this->createAnArrayOfReportRecords($numberOfLines);
    }

    private function createAnArrayOfReportRecords(int $numberOfLines): array
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

    private function filingInObjectFromReportLine(mixed $object): mixed
    {
        $lineReport = $this->report->getReportLine();
        if ($this->isNotEmptyReportLine($lineReport)) {
            foreach ($lineReport as $key => $value) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    private function isNotEmptyReportLine(mixed $lineReport): bool
    {
        if (is_array($lineReport) && count($lineReport) > 0) {
            return true;
        } else {
            return false;
        }
    }
}