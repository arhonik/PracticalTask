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
        fclose($this->file);
    }

    public function ifNeedGoToHeaderFromBody()
    {
        if (!$this->isBeginning()) {
            $rewindControl = rewind($this->file);
            if (!$rewindControl) {
                throw new \Exception('File not available');
            }
        }
    }

    public function ifNeedGoToBodyFromHeader()
    {
        if ($this->isBeginning()) {
            $this->goToNextLine();
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

    public function getPointerPosition(): bool|int
    {
        return ftell($this->file);
    }

    public function getLine(): array
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
        $reportLine = fgetcsv($this->file, 0, ';');
        if ($reportLine == false) {
            throw new \Exception('File not available');
        }

        return $reportLine;
    }

    private function goToNextLine()
    {
        fgetcsv($this->file, 0, ';');
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