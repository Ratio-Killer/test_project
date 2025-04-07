<?php

namespace App\Actions\User;

use App\Contracts\Actions\User\GetUsersActionContract;
use App\DataTransferObjects\User\GetUsersDTO;
use App\Exceptions\PageNotFoundException;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Facades\ApiPaginator;


class GetUsersAction implements GetUsersActionContract
{

    /**
     * @param GetUsersDTO $data
     * @return array
     * @throws PageNotFoundException
     */
    public function __invoke(GetUsersDTO $data): array
    {
        $users = User::with('position')->get();

        $total = $users->count();
        $page = $data->page ?? 1;
        $perPage = $data->count ?? 10;
        $maxPages = ceil($total / $perPage);

        if ($page > $maxPages && $total > 0) {
            throw new PageNotFoundException();
        }

        $paginated = $users->forPage($page, $perPage)->values();

        $paginatedData = ApiPaginator::paginate($users->toArray(), $page, $perPage, $total);
        $paginatedData['data'] = $paginated->map(function ($user) {
            $user->with_timestamp = true;
            return (new UserResource($user))->resolve();
        });

        return $paginatedData;
    }
}
