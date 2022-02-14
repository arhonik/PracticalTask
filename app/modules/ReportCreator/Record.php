<?php

namespace App\Modules\ReportCreator;

class Record implements RecordInterface
{
    private ?int $id = null;
    private ?string $customerName = null;
    private ?string $productName = null;
    private ?string $productQuantity = null;
    private ?string $productArticle = null;
    private ?string $productWeight = null;
    private ?string $productPrice = null;

    public function __construct(ColumnHeaders $columnHeaders, array $dataArray)
    {
        if (!is_null($columnHeaders->getIdData()->getPosition())) {
            $this->id = (int) $dataArray[
                $columnHeaders->getIdData()->getPosition()
            ];
        }
        if (!is_null($columnHeaders->getCustomerNameData())) {
            $this->customerName = $dataArray[
                $columnHeaders->getCustomerNameData()->getPosition()
            ];
        }
        if (!is_null($columnHeaders->getProductNameData())) {
            $this->productName = $dataArray[
                $columnHeaders->getProductNameData()->getPosition()
            ];
        }
        if (!is_null($columnHeaders->getProductQuantityData())) {
            $this->productQuantity = $dataArray[
                $columnHeaders->getProductQuantityData()->getPosition()
            ];

        }
        if (!is_null($columnHeaders->getProductArticleData())) {
            $this->productArticle = $dataArray[
                $columnHeaders->getProductArticleData()->getPosition()
            ];

        }
        if (!is_null($columnHeaders->getProductWeightData())) {
            $this->productWeight = $dataArray[
                $columnHeaders->getProductWeightData()->getPosition()
            ];

        }
        if (!is_null($columnHeaders->getProductPriceData())) {
            $this->productPrice = $dataArray[
                $columnHeaders->getProductPriceData()->getPosition()
            ];
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function getProductQuantity(): ?string
    {
        return $this->productQuantity;
    }

    public function getProductArticle(): ?string
    {
        return $this->productArticle;
    }

    public function getProductWeight(): ?string
    {
        return $this->productWeight;
    }

    public function getProductPrice(): ?string
    {
        return $this->productPrice;
    }
}