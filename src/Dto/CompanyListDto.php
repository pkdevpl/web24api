<?php

namespace App\Dto;

class CompanyListDto
{
    public array $companies;
    public ?int $page;
    public ?int $perPage;
    public ?int $totalPages;

    public function __construct()
    {
        $this->companies = [];
        $this->page = null;
        $this->perPage = null;
        $this->totalPages = null;
    }

}