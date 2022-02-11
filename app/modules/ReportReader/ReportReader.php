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
        $this->report->ifNeedGoToHeaderFromBody();
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
        return $this->filingInObjectFromReportLine($emptyReportHeader);
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
        $lineReport = $this->report->getLine();
        if ($this->isFillReportLine($lineReport)) {
            $object->setId($lineReport[0]);
            $object->setCustomerName($lineReport[1]);
            $object->setProductName($lineReport[2]);
            $object->setProductQuantity($lineReport[3]);
            $object->setProductArticle($lineReport[4]);
            $object->setProductWeight($lineReport[5]);
            $object->setProductPrice($lineReport[6]);
        } else {
            $object = null;
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