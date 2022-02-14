<?php

namespace App\Modules\ReportCreator;

class ColumnHeaders implements ColumnHeadersInterface
{
    private ?HeaderData $idData = null;
    private ?HeaderData $customerNameData = null;
    private ?HeaderData $productNameData = null;
    private ?HeaderData $productQuantityData = null;
    private ?HeaderData $productArticleData = null;
    private ?HeaderData $productWeightData = null;
    private ?HeaderData $productPriceData = null;

    public function __construct(array $row)
    {
        foreach ($row as $position => $title) {
            switch ($title) {
                case ColumnName::ID:
                    $this->idData = new HeaderData($title, $position);
                    break;
                case ColumnName::CUSTOMER_NAME:
                    $this->customerNameData = new HeaderData($title, $position);
                    break;
                case ColumnName::PRODUCT_NAME:
                    $this->productNameData = new HeaderData($title, $position);
                    break;
                case ColumnName::PRODUCT_QUANTITY:
                    $this->productQuantityData = new HeaderData($title, $position);
                    break;
                case ColumnName::PRODUCT_ARTICLE:
                    $this->productArticleData = new HeaderData($title, $position);
                    break;
                case ColumnName::PRODUCT_WEIGHT:
                    $this->productWeightData = new HeaderData($title, $position);
                    break;
                case ColumnName::PRODUCT_PRICE:
                    $this->productPriceData = new HeaderData($title, $position);
                    break;
            }
        }
    }

    public function getIdData(): ?HeaderData
    {
        return $this->idData;
    }

    public function getCustomerNameData(): ?HeaderData
    {
        return $this->customerNameData;
    }

    public function getProductNameData(): ?HeaderData
    {
        return $this->productNameData;
    }

    public function getProductQuantityData(): ?HeaderData
    {
        return $this->productQuantityData;
    }

    public function getProductArticleData(): ?HeaderData
    {
        return $this->productArticleData;
    }

    public function getProductWeightData(): ?HeaderData
    {
        return $this->productWeightData;
    }

    public function getProductPriceData(): ?HeaderData
    {
        return $this->productPriceData;
    }
}