<?php

namespace App\Modules\ReportCreator;

class Report implements ReportInterface
{
    private CSVFile $file;

    public function __construct(string $fullPathToFile)
    {
        $this->file = new CSVFile($fullPathToFile);
    }

    public function getHeader(): ?ReportLineInterface
    {
        $this->file->ifNeedGoToHeaderFromBody();
        return $this->createRecord();
    }

    public function getRecord(): ?ReportLineInterface
    {
        $this->file->ifNeedGoToBodyFromHeader();
        return $this->createRecord();
    }

    public function getChunk(int $numberOfLines): ?array
    {
        $this->file->ifNeedGoToBodyFromHeader();
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
        if (!$this->file->isEnding()) {
            return $this->filingInObjectFromReportLine();
        } else {
            return null;
        }
    }

    private function filingInObjectFromReportLine(): ?ReportLineInterface
    {
        $reportLine = $this->file->getLine();
        if ($this->file->isFillLine($reportLine)) {
            $reportRecord = new ReportRecord($reportLine);
        } else {
            $reportRecord = null;
        }

        return $reportRecord;
    }
}