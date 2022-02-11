<?php

namespace App\Modules\ReportReader;

class ReportReader implements ReportReaderInterface
{
    private Report $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new Report($fullPathToReport);
    }

    public function getReportHeader(): ?ReportHeader
    {
        $this->report->goToHeaders();
        return $this->createReportHeader();
    }

    public function getReportRecord(): ?ReportRecord
    {
        $this->report->ifNeedGoToBodyFromHeader();
        return $this->createReportRecord();
    }

    public function getReportChunk(int $numberOfLines): ?array
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

    private function createReportHeader(): ?ReportLineInterface
    {
        $emptyReportHeader = new ReportHeader();
        return null;
    }

    private function createReportRecord(): ?ReportRecord
    {
        if (!$this->report->isEnding()) {
            $emptyReportRecord = new ReportRecord();
            return $this->filingInObjectFromReportLine($emptyReportRecord);
        } else {
            return null;
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