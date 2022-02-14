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
            $columnHeaders->getIdData()->getPosition()
        ];
        $this->customerName = $dataArray[
            $columnHeaders->getCustomerNameData()->getPosition()
        ];
        $this->productName = $dataArray[
            $columnHeaders->getProductNameData()->getPosition()
        ];
        $this->productQuantity = $dataArray[
            $columnHeaders->getProductQuantityData()->getPosition()
        ];
        $this->productArticle = $dataArray[
            $columnHeaders->getProductArticleData()->getPosition()
        ];
        $this->productWeight = $dataArray[
            $columnHeaders->getProductWeightData()->getPosition()
        ];
        $this->productPrice = $dataArray[
            $columnHeaders->getProductPriceData()->getPosition()
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