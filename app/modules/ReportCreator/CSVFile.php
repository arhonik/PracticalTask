<?php

namespace App\Modules\ReportCreator;

class CSVFile
{
    private mixed $report;

    public function __construct($fullPathToReport)
    {
        try {
            $this->open($fullPathToReport);
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
            exit();
        }
    }

    private function open($fullPathToReport)
    {
        if (file_exists($fullPathToReport)) {
            $this->report = fopen($fullPathToReport, 'rt');
        } else {
            throw new \Exception('File not found');
        }
    }

    private function close()
    {
        fclose($this->report);
    }

    public function ifNeedGoToHeaderFromBody()
    {
        if (!$this->isBeginningFile()) {
            if (!rewind($this->report)) {
                throw new \Exception('File not available');
            }
        }
    }

    public function ifNeedGoToBodyFromHeader()
    {
        if ($this->isBeginningFile()) {
            $this->goToNextLineReport();
        }
    }

    private function isBeginningFile(): bool
    {
        if ($this->getPointerPosition() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isEnding(): bool
    {
        if (feof($this->report)) {
            return true;
        } else {
            return false;
        }
    }

    public function getPointerPosition(): bool|int
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
            throw new \Exception('File not available');
        }

        return $reportLine;
    }

    private function goToNextLineReport()
    {
        fgetcsv($this->report, 0, ';');
    }

    public function isFillLine(mixed $lineReport): bool
    {
        if (is_array($lineReport) && count($lineReport) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}