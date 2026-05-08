<?php

declare(strict_types=1);

namespace App\Core\Pagination;

final class Paginator
{
    public function __construct(
        private int $page,
        private int $perPage,
        private int $total,
    ) {
    }

    public function offset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }

    public function pages(): int
    {
        return (int) ceil($this->total / $this->perPage);
    }

    public function toArray(): array
    {
        return [
            'page' => $this->page,
            'per_page' => $this->perPage,
            'total' => $this->total,
            'pages' => $this->pages(),
            'has_prev' => $this->page > 1,
            'has_next' => $this->page < $this->pages(),
            'prev_page' => $this->page - 1,
            'next_page' => $this->page + 1,
        ];
    }
}
