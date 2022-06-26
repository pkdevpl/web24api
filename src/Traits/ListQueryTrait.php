<?php

namespace App\Traits;

trait ListQueryTrait
{
    private ?int $page = 1;
    private ?int $perPage = 10;
    private ?string $queryField = null;
    private ?string $query = null;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    public function setPerPage(?int $perPage): void
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