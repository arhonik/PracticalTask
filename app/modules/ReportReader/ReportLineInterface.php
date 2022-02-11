<?php

namespace App\Modules\ReportReader;

interface ReportLineInterface
{
    public function getId(): string;

    public function getCustomerName(): string;

    public function getProductName(): string;

    public function getProductQuantity(): string;

    public function getProductArticle(): string;

    public function getProductWeight(): string;

    public function getProductPrice(): string;

}