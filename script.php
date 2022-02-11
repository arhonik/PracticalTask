<?php

require_once __DIR__.'/autoload.php';

$fullPathToReport = __DIR__ . '/resource/report.csv';
$report = new \App\Modules\ReportCreator\Report($fullPathToReport);
$header = $report->getHeader();
while ($data = $report->getRecord()) {
    //process report data
}
while ($data = $report->getChunk(3)) {
    //process report data
}