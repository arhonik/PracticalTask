<?php

namespace App;

class Report
{
    private mixed $report;

    public function __construct($fullPathToReport)
    {
        try {
            $this->openReport($fullPathToReport);
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
            exit();
        }
    }

    private function openReport($fullPathToReport)
    {
        if (file_exists($fullPathToReport)) {
            $this->report = fopen($fullPathToReport, 'rt');
        } else {
            throw new \Exception('Report not found');
        }
    }

    private function closeReport()
    {
        fclose($this->report);
    }

    public function goToReportHeaders()
    {
        rewind($this->report);
    }

    public function ifNeedGoToBodyFromHeaderReport()
    {
        if ($this->isBeginningFile()) {
            $this->goToNextLineReport();
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

    public function isNotEndingFile(): bool
    {
        if (feof($this->report)) {
            return false;
        } else {
            return true;
        }
    }

    public function getPointerPositionReport(): bool|int
    {
        return ftell($this->report);
    }

    public function getReportLine(): bool|array
    {
        return fgetcsv($this->report, 0, ';');
    }

    private function goToNextLineReport()
    {
        fgetcsv($this->report, 0, ';');
    }

    public function __destruct()
    {
        $this->closeReport();
    }
}