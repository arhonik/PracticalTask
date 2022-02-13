<?php

namespace App\Modules\ReportCreator;

class Report implements ReportInterface
{
    private CSVFileReader $fileReader;

    public function __construct(string $fullPathToFile)
    {
        $this->fileReader = new CSVFileReader($fullPathToFile);
    }

    public function getHeaders(): ?ColumnHeaders
    {
        $this->fileReader->ifNeedGoToHeaderFromBody();
        return $this->createRecord();
    }

    public function getRecord(): ?RecordInterface
    {
        $this->fileReader->ifNeedGoToBodyFromHeader();
        return $this->createRecord();
    }

    public function getChunk(int $numberOfRecords): ?array
    {
        $this->fileReader->ifNeedGoToBodyFromHeader();
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

    private function createRecord(): ?RecordInterface
    {
        if (!$this->fileReader->isEnding()) {
            return $this->filingInObjectFromReportLine();
        } else {
            return null;
        }
    }

    private function filingInObjectFromReportLine(): ?RecordInterface
    {
        $fileLine = $this->fileReader->getRow();
        //TODO Take the isArrayWithData method to another level of abstraction
        if ($this->fileReader->isArrayWithData($fileLine)) {
            $record = new Record($this->headers, $fileLine);
        } else {
            $record = null;
        }

        return $record;
    }
}