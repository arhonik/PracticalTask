<?php

namespace App\Modules\ReportCreator;

class Report implements ReportInterface
{
    private CSVFile $file;

    public function __construct(string $fullPathToFile)
    {
        $this->file = new CSVFile($fullPathToFile);
    }

    public function getHeader(): ?ReportRecordInterface
    {
        $this->file->ifNeedGoToHeaderFromBody();
        return $this->createRecord();
    }

    public function getRecord(): ?ReportRecordInterface
    {
        $this->file->ifNeedGoToBodyFromHeader();
        return $this->createRecord();
    }

    public function getChunk(int $numberOfRecords): ?array
    {
        $this->file->ifNeedGoToBodyFromHeader();
        return $this->createAnArrayOfRecords($numberOfRecords);
    }

    private function createAnArrayOfRecords(int $numberOfRecords): array
    {
        $arrayRecord = array();
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $record = $this->createRecord();
            if (!is_null($record)) {
                $arrayRecord[] = $record;
            }
        }

        return $arrayRecord;
    }

    private function createRecord(): ?ReportRecordInterface
    {
        if (!$this->file->isEnding()) {
            return $this->filingInObjectFromReportLine();
        } else {
            return null;
        }
    }

    private function filingInObjectFromReportLine(): ?ReportRecordInterface
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