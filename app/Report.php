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

    public function goToHeaders()
    {
        rewind($this->report);
    }

    public function ifNeedGoToBodyFromHeader()
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

    public function isNotEnding(): bool
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

    public function getLine(): bool|array
    {
        try {
            $reportLine = $this->getTheLineSafely();
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
            exit();

        }
        return $reportLine;
    }

    private function getTheLineSafely(): array
    {
        $reportLine = fgetcsv($this->report, 0, ';');
        if ($reportLine == false) {
            throw new \Exception('Report not available');
        }

        return $reportLine;
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