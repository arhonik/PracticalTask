<?php

namespace App\Modules\ReportCreator;

class Record implements RecordInterface
{
    private string $id;
    private string $customerName;
    private string $productName;
    private string $productQuantity;
    private string $productArticle;
    private string $productWeight;
    private string $productPrice;

    public function __construct(ColumnHeaders $columnHeaders, array $dataArray)
    {
        $this->id = $dataArray[
            $columnHeaders->getIdInfo()->getPosition()
        ];
        $this->customerName = $dataArray[
            $columnHeaders->getCustomerNameInfo()->getPosition()
        ];
        $this->productName = $dataArray[
            $columnHeaders->getProductNameInfo()->getPosition()
        ];
        $this->productQuantity = $dataArray[
            $columnHeaders->getProductQuantityInfo()->getPosition()
        ];
        $this->productArticle = $dataArray[
            $columnHeaders->getProductArticleInfo()->getPosition()
        ];
        $this->productWeight = $dataArray[
            $columnHeaders->getProductWeightInfo()->getPosition()
        ];
        $this->productPrice = $dataArray[
            $columnHeaders->getProductPriceInfo()->getPosition()
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getProductQuantity(): string
    {
        return $this->productQuantity;
    }

    public function getProductArticle(): string
    {
        return $this->productArticle;
    }

    public function getProductWeight(): string
    {
        return $this->productWeight;
    }

    public function getProductPrice(): string
    {
        return $this->productPrice;
    }
}