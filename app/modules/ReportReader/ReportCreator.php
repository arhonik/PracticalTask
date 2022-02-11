<?php

namespace App\Modules\ReportReader;

class ReportCreator implements ReportReaderInterface
{
    private Report $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new Report($fullPathToReport);
    }

    public function getHeader(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToHeaderFromBody();
        return $this->createReportRecord();
    }

    public function getRecord(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToBodyFromHeader();
        return $this->createReportRecord();
    }

    public function getChunk(int $numberOfLines): ?array
    {
        $this->report->ifNeedGoToBodyFromHeader();
        return $this->createAnArrayOfRecords($numberOfLines);
    }

    private function createAnArrayOfRecords(int $numberOfLines): array
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

    private function createReportRecord(): ?ReportLineInterface
    {
        if (!$this->report->isEnding()) {
            $emptyReportHeader = new ReportRecord();
            return $this->filingInObjectFromReportLine($emptyReportHeader);
        } else {
            return null;
        }
    }

    private function filingInObjectFromReportLine(ReportLineInterface $object): ?ReportLineInterface
    {
        $reportLine = $this->report->getLine();
        if ($this->report->isFillLine($reportLine)) {
            $reportRecord = new ReportRecord($reportLine);
        } else {
            $reportRecord = null;
        }

        return $reportRecord;
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