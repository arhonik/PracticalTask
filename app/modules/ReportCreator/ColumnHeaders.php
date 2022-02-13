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
        foreach ($row as $position => $title) {
            switch ($title) {
                case ColumnName::ID:
                    $this->idInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::CUSTOMER_NAME:
                    $this->customerNameInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::PRODUCT_NAME:
                    $this->productNameInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::PRODUCT_QUANTITY:
                    $this->productQuantityInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::PRODUCT_ARTICLE:
                    $this->productArticleInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::PRODUCT_WEIGHT:
                    $this->productWeightInfo = new HeaderInfo($title, $position);
                    break;
                case ColumnName::PRODUCT_PRICE:
                    $this->productPriceInfo = new HeaderInfo($title, $position);
                    break;
            }
        }
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