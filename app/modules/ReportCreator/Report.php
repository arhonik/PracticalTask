<?php

namespace App\Modules\ReportCreator;

class Report implements ReportInterface
{
    private CSVFileReader $fileReader;
    private ColumnHeaders $headers;

    public function __construct(string $fullPathToFile)
    {
        $this->fileReader = new CSVFileReader($fullPathToFile);
        $this->headers = $this->getHeaders();
    }

    public function getHeaders(): ?ColumnHeaders
    {
        $this->fileReader->ifNeedGoToHeaderFromBody();
        return $this->createHeader();
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

    private function createHeader(): ?ColumnHeaders
    {
        $row = $this->fileReader->getRow();
        if (ArrayAnalyzer::isArrayWithData($row)) {
            $record = new ColumnHeaders($row);
        } else {
            $record = null;
        }

        return $record;
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
        $row = $this->fileReader->getRow();
        if (ArrayAnalyzer::isArrayWithData($row)) {
            $record = new Record($this->headers, $row);
        } else {
            $record = null;
        }

        return $record;
    }
}