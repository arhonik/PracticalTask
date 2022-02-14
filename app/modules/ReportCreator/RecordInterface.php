<?php

namespace App\Modules\ReportCreator;

interface RecordInterface
{
    public function getId(): ?int;

    public function getCustomerName(): ?string;

    public function getProductName(): ?string;

    public function getProductQuantity(): ?string;

    public function getProductArticle(): ?string;

    public function getProductWeight(): ?string;

    public function getProductPrice(): ?string;

}