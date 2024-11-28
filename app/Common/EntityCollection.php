<?php

namespace App\Common;

use Illuminate\Support\Collection;

class EntityCollection extends Collection
{
    private ?int $page = null;

    private ?int $perPage = null;

    private ?int $lastPage = null;

    private ?int $total = null;

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param int $perPage
     * @return $this
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param int $total
     * @return $this
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLastPage(): ?int
    {
        return $this->lastPage;
    }

    /**
     * @param int|null $lastPage
     * @return $this
     */
    public function setLastPage(?int $lastPage): self
    {
        $this->lastPage = $lastPage;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @return int|null
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }
}
