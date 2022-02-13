<?php

namespace App\Modules\ReportCreator;

class ColumnHeaders
{
    private HeaderInfo $idInfo;
    private HeaderInfo $customerNameInfo;
    private HeaderInfo $productNameInfo;
    private HeaderInfo $productQuantityInfo;
    private HeaderInfo $productArticleInfo;
    private HeaderInfo $productWeightInfo;
    private HeaderInfo $productPriceInfo;

    public function __construct(array $row)
    {
    }

    public function getIdInfo(): HeaderInfo
    {
        return $this->idInfo;
    }

    public function getCustomerNameInfo(): HeaderInfo
    {
        return $this->customerNameInfo;
    }

    public function getProductNameInfo(): HeaderInfo
    {
        return $this->productNameInfo;
    }

    public function getProductQuantityInfo(): HeaderInfo
    {
        return $this->productQuantityInfo;
    }

    public function getProductArticleInfo(): HeaderInfo
    {
        return $this->productArticleInfo;
    }

    public function getProductWeightInfo(): HeaderInfo
    {
        return $this->productWeightInfo;
    }

    public function getProductPriceInfo(): HeaderInfo
    {
        return $this->productPriceInfo;
    }
}