<?php

namespace App\Support;

class ApiPaginatorSupport
{
    public const int PER_PAGE = 10;

    /**
     * @param array $items
     * @param int $page
     * @param int $perPage
     * @param int $totalItems
     * @return array|array[]
     */
    public function paginate(array $items, int $page = 1, int $perPage = self::PER_PAGE, int $totalItems = 0): array
    {

        $perPage = max($perPage, 1);
        $totalPages = (int)ceil($totalItems / $perPage);
        $currentPage = max(min($page, $totalPages), 1);
        $data = array_slice($items, ($currentPage - 1) * $perPage, $perPage);

        return [
            'data' => $data,
            'total' => $totalItems,
            'count' => $perPage,
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'links' => [
                'next_url' => $currentPage < $totalPages ? $this->generateUrl($currentPage + 1) : null,
                'prev_url' => $currentPage > 1 ? $this->generateUrl($currentPage - 1) : null,
            ],
        ];
    }

    /**
     * @param int $page
     * @return string
     */
    private function generateUrl(int $page): string
    {
        return request()->url() . '?page=' . $page;
    }
}
