<?php

namespace App\Dto;

class EmployeeListDto
{
    public array $employees;
    public ?int $page;
    public ?int $perPage;
    public ?int $totalPages;

    public function __construct()
    {
        $this->employees = [];
        $this->page = null;
        $this->perPage = null;
        $this->totalPages = null;
    }
}