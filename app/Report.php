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

    }

    public function getPointerPositionReport()
    {

    }

    public function getLneReport()
    {

    }

    private function goToNextLineReport()
    {

    }

    public function __destruct()
    {
    }
}