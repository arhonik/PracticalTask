<?php

namespace App\Modules\ReportReader;

class ReportRecord implements ReportLineInterface
{
    private string $id;
    private string $customerName;
    private string $productName;
    private string $productQuantity;
    private string $productArticle;
    private string $productWeight;
    private string $productPrice;

    public function __construct(array $reportLine)
    {
        $this->id = $reportLine[0];
        $this->customerName = $reportLine[1];
        $this->productName = $reportLine[2];
        $this->productQuantity = $reportLine[3];
        $this->productArticle = $reportLine[4];
        $this->productWeight = $reportLine[5];
        $this->productWeight = $reportLine[6];
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