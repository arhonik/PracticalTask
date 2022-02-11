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

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductQuantity(string $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }

    public function getProductQuantity(): string
    {
        return $this->productQuantity;
    }

    public function setProductArticle(string $productArticle): void
    {
        $this->productArticle = $productArticle;
    }

    public function getProductArticle(): string
    {
        return $this->productArticle;
    }

    public function setProductWeight(string $productWeight): void
    {
        $this->productWeight = $productWeight;
    }

    public function getProductWeight(): string
    {
        return $this->productWeight;
    }

    public function setProductPrice(string $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    public function getProductPrice(): string
    {
        return $this->productPrice;
    }
}