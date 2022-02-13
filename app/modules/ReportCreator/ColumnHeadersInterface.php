<?php

namespace App\Modules\ReportCreator;

interface ColumnHeadersInterface
{
    public function getIdInfo(): HeaderInfo;

    public function getCustomerNameInfo(): HeaderInfo;

    public function getProductNameInfo(): HeaderInfo;

    public function getProductQuantityInfo(): HeaderInfo;

    public function getProductArticleInfo(): HeaderInfo;

    public function getProductWeightInfo(): HeaderInfo;

    public function getProductPriceInfo(): HeaderInfo;
}