<?php

require_once __DIR__.'/autoload.php';

$fullPathToFile = __DIR__ . '/resource/sales_data.csv';
$report = new \App\Modules\ReportCreator\Report($fullPathToFile);
$header = $report->getHeader();
while ($data = $report->getRecord()) {
    //process report data
}
while ($data = $report->getChunk(3)) {
    //process report data
}