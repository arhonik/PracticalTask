<?php

require_once __DIR__.'/autoload.php';

$fullPathToReport = __DIR__ . '/resource/report.csv';
$reportReader = new \App\ReportReader($fullPathToReport);
$header = $reportReader->getReportHeader();
while ($data = $reportReader->getReportRecord()) {
    //process report data
}
while ($data = $reportReader->getReportChunk(3)) {
    //process report data
}