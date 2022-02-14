<?php

namespace App\Modules\ReportCreator;

class HeaderData implements HeaderDataInterface
{
    private string $name;
    private int $position;

    public function __construct(string $name, int $position)
    {
        $this->name = $name;
        $this->position = $position;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): int
    {
        return $this->position;
    }
}