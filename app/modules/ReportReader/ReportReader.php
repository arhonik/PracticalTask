<?php

namespace App\Modules\ReportReader;

class ReportReader implements ReportReaderInterface
{
    private Report $report;

    public function __construct($fullPathToReport)
    {
        $this->report = new Report($fullPathToReport);
    }

    public function getReportHeader(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToHeaderFromBody();
        $reportLine = $this->report->getLine();
        if ($this->isFillReportLine($reportLine)) {
            $reportHeader = new ReportHeader();
            $reportHeader->setId($reportLine[0]);
            $reportHeader->setCustomerName($reportLine[1]);
            $reportHeader->setProductName($reportLine[2]);
            $reportHeader->setProductQuantity($reportLine[3]);
            $reportHeader->setProductArticle($reportLine[4]);
            $reportHeader->setProductWeight($reportLine[5]);
            $reportHeader->setProductPrice($reportLine[6]);

            return $reportHeader;
        } else {
            return null;
        }
    }

    public function getReportRecord(): ?ReportLineInterface
    {
        $this->report->ifNeedGoToBodyFromHeader();
        $reportLine = $this->report->getLine();
        if ($this->isFillReportLine($reportLine)) {
            $reportRecord = new ReportRecord();
            $reportRecord->setId($reportLine[0]);
            $reportRecord->setCustomerName($reportLine[1]);
            $reportRecord->setProductName($reportLine[2]);
            $reportRecord->setProductQuantity($reportLine[3]);
            $reportRecord->setProductArticle($reportLine[4]);
            $reportRecord->setProductWeight($reportLine[5]);
            $reportRecord->setProductPrice($reportLine[6]);

            return $reportRecord;
        } else {
            return null;
        }
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