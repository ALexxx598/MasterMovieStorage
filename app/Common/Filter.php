<?php

namespace App\Common;

class Filter implements FilterInterface
{
    protected const PAGE = 1;
    protected const PER_PAGE = 10;

    private ?int $page;

    private ?int $perPage;

    /**
     * @return static
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * @param int|null $page
     * @return $this
     */
    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @param int|null $perPage
     * @return $this
     */
    public function setPerPage(?int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page ?? self::PAGE;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage ?? self::PER_PAGE;
    }
}
