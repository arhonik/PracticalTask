<?php

namespace App;

class ReportReader implements ReportReaderInterface
{
    private \App\Report $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new \App\Report($fullPathToReport);
    }

    public function getReportHeader(): \App\ReportLineInterface
    {
        $this->report->goToHeaders();
        return $this->createReportHeader();
    }

    public function getReportRecord(): \App\ReportLineInterface|bool
    {
        $this->report->ifNeedGoToBodyFromHeader();
        return $this->createReportRecord();
    }

    public function getReportChunk(int $numberOfLines): array|bool
    {
        $this->report->ifNeedGoToBodyFromHeader();
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

    private function createReportHeader(): \App\ReportLineInterface
    {
        $emptyReportHeader = new \App\ReportHeader();
        return $this->filingInObjectFromReportLine($emptyReportHeader);
    }

    private function createReportRecord(): \App\ReportRecord|bool
    {
        if ($this->report->isNotEnding()) {
            $emptyReportRecord = new \App\ReportRecord();
            return $this->filingInObjectFromReportLine($emptyReportRecord);
        } else {
            return false;
        }
    }

    private function filingInObjectFromReportLine(mixed $object): mixed
    {
        $lineReport = $this->report->getLine();
        if ($this->isFillReportLine($lineReport)) {
            foreach ($lineReport as $key => $value) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    private function isFillReportLine(mixed $lineReport): bool
    {
        if (is_array($lineReport) && count($lineReport) > 0) {
            return true;
        } else {
            return false;
        }
    }
}