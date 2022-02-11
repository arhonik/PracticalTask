<?php

require_once __DIR__.'/autoload.php';

$fullPathToReport = __DIR__ . '/resource/report.csv';
$reportCreator = new \App\Modules\ReportCreator\ReportCreator($fullPathToReport);
$header = $reportCreator->getHeader();
while ($data = $reportCreator->getRecord()) {
    //process report data
}
while ($data = $reportCreator->getChunk(3)) {
    //process report data
}