<?php

namespace App\Modules\ReportCreator;

interface ColumnHeadersInterface
{
    public function getIdData(): ?HeaderData;

    public function getCustomerNameData(): ?HeaderData;

    public function getProductNameData(): ?HeaderData;

    public function getProductQuantityData(): ?HeaderData;

    public function getProductArticleData(): ?HeaderData;

    public function getProductWeightData(): ?HeaderData;

    public function getProductPriceData(): ?HeaderData;
}