<?php

namespace App\Modules\ReportCreator;

interface ReportRecordInterface
{
    public function getId(): string;

    public function getCustomerName(): string;

    public function getProductName(): string;

    public function getProductQuantity(): string;

    public function getProductArticle(): string;

    public function getProductWeight(): string;

    public function getProductPrice(): string;

}