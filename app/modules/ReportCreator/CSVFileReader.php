<?php

namespace App\Modules\ReportCreator;

class CSVFileReader
{
    private mixed $file;

    public function __construct(string $fullPathToFile)
    {
        try {
            $this->open($fullPathToFile);
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
            exit();
        }
    }

    private function open($fullPathToFile)
    {
        if (file_exists($fullPathToFile)) {
            $this->file = fopen($fullPathToFile, 'rt');
        } else {
            throw new \Exception('File not found');
        }
    }

    private function close()
    {
        if (!fclose($this->file)) {
            throw new \Exception('File not available');
        }
    }

    public function ifNeedGoToHeaderFromBody()
    {
        if (!$this->isBeginning()) {
            try {
                $this->rewindPosition();
            } catch (\Exception $e) {
                throw new \Exception('File not available');
            }
        }
    }

    private function rewindPosition()
    {
        $rewindControl = rewind($this->file);
        if ($rewindControl === false) {
            throw new \Exception('File not available');
        }
    }

    public function ifNeedGoToBodyFromHeader()
    {
        if ($this->isBeginning()) {
            $this->goToNextRow();
        }
    }

    private function isBeginning(): bool
    {
        if ($this->getPointerPosition() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isEnding(): bool
    {
        if (feof($this->file)) {
            return true;
        } else {
            return false;
        }
    }

    public function getPointerPosition(): int
    {
        try {
            $position = $this->tryGetPointerPosition();
        } catch (\Exception $e) {
            throw new \Exception('File not available');
        }

        return $position;
    }

    private function tryGetPointerPosition(): int
    {
        $position = ftell($this->file);
        if ($position === false) {
            throw new \Exception('File not available');
        }

        return $position;
    }

    public function getRow(): array
    {
        try {
            $reportLine = $this->tryGetTheRow();
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
            exit();
        }
        return $reportLine;
    }

    private function tryGetTheRow(): array
    {
        $reportLine = fgetcsv($this->file, 0, ';');
        if ($reportLine === false) {
            throw new \Exception('File not available');
        }

        return $reportLine;
    }

    private function goToNextRow()
    {
        try {
            $this->tryGoToNextRow();
        } catch (\Exception $e) {
            throw new \Exception('File not available');
        }
    }

    private function tryGoToNextRow()
    {
        $reportLine = fgetcsv($this->file, 0, ';');
        if ($reportLine === false) {
            throw new \Exception('File not available');
        }
    }

    public function isArrayWithData(mixed $lineReport): bool
    {
        if (is_array($lineReport) && count($lineReport) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        try {
            $this->close();
        } catch (\Exception $e) {
            echo 'Exceptions caught: ' . $e->getMessage();
        }
    }
}