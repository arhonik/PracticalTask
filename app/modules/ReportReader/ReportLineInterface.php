<?php

namespace App\Modules\ReportReader;

interface ReportLineInterface
{
    public function setId(string $id);

    public function getId(): string;

    public function setCustomerName(string $customerName): void;

    public function getCustomerName(): string;

    public function setProductName(string $productName): void;

    public function getProductName(): string;

    public function setProductQuantity(string $productQuantity): void;

    public function getProductQuantity(): string;

    public function setProductArticle(string $productArticle): void;

    public function getProductArticle(): string;

    public function setProductWeight(string $productWeight): void;

    public function getProductWeight(): string;

    public function setProductPrice(string $productPrice): void;

    public function getProductPrice(): string;

}