<?php

require_once __DIR__.'/autoload.php';

$fullPathToReport = __DIR__ . '/resource/report.csv';
$reportReader = new \App\ReportReader($fullPathToReport);
$header = $reportReader->readReportHeader();
while ($data = $reportReader->readReportRecord()) {
    //process report data
}
while ($data = $reportReader->readChunkReport(3)) {
    //process report data
}