<?php

namespace App\Modules\ReportCreator;

class ReportCreator implements ReportReaderInterface
{
    private CSVFile $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new CSVFile($fullPathToReport);
    }

    public function getHeader(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToHeaderFromBody();
        return $this->createRecord();
    }

    public function getRecord(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToBodyFromHeader();
        return $this->createRecord();
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
            $reportRecord = $this->createRecord();
            if ($reportRecord) {
                $arrayReportRecord[] = $reportRecord;
            }
        }

        return $arrayReportRecord;
    }

    private function createRecord(): ?ReportLineInterface
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
}