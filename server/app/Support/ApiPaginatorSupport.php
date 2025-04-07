<?php

namespace App\Support;

class ApiPaginatorSupport
{
    public const int PER_PAGE = 10;

    /**
     * @param array $items
     * @param int $page
     * @param int $per_page
     * @param int $total_items
     * @return array|array[]
     */
    public function paginate(array $items, int $page = 1, int $per_page = self::PER_PAGE, int $total_items = 0): array
    {

        $per_page = max($per_page, 1);
        $total_pages = (int)ceil($total_items / $per_page);
        $current_page = max(min($page, $total_pages), 1);
        $data = array_slice($items, ($current_page - 1) * $per_page, $per_page);

        return [
            'data' => $data,
            'total' => $total_items,
            'count' => $per_page,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'links' => [
                'next_url' => $current_page < $total_pages ? $this->generateUrl($current_page + 1) : null,
                'prev_url' => $current_page > 1 ? $this->generateUrl($current_page - 1) : null,
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
