<?php

namespace App\Dto;

class CompanyDto
{
    public ?int $id;
    public ?string $name;
    public ?string $nip;
    public ?string $address;
    public ?string $city;
    public ?string $postal;

    public function __construct()
    {
        $this->id = null;
        $this->name = null;
        $this->nip = null;
        $this->address = null;
        $this->city = null;
        $this->postal = null;
    }
}