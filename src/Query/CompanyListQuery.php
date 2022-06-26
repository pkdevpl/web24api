<?php

namespace App\Query;

class CompanyListQuery implements QueryInterface
{
    private int $page;
    private int $perPage;
    private ?string $queryField;
    private ?string $query;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function setQuery(?string $query): void
    {
        $this->query = $query;
    }

    public function getQueryField(): ?string
    {
        return $this->queryField;
    }

    public function setQueryField(?string $queryField): void
    {
        $this->queryField = $queryField;
    }
}