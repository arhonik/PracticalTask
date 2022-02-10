<?php

namespace App;

class Report
{
    private mixed $report;

    public function __construct($fullPathToReport)
    {
        $this->report = fopen($fullPathToReport, 'rt');
    }

    public function goToHeadersReport()
    {
        rewind($this->report);
    }

    public function goToBodyReport()
    {
        if ($this->isBeginningFile()) {
            fgetcsv($this->report, 0, ';');
        }
    }

    private function isBeginningFile(): bool
    {
        if ($this->getPointerPositionReport() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPointerPositionReport(): bool|int
    {
        return ftell($this->report);
    }

    public function getLneReport(): bool|array
    {
        return fgetcsv($this->report, 0, ';');
    }

    private function goToNextLineReport()
    {

    }

    public function __destruct()
    {
    }
}