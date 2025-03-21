<?php

namespace App\Services;

use App\DataTransferObjects\User\GetUserDTO;
use App\DataTransferObjects\User\UserStoreDTO;
use App\Facades\HttpRequest;
use Illuminate\Support\Facades\Http;
use App\Contracts\Services\AbzApiServiceContract;

class AbzApiService implements AbzApiServiceContract
{

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var array
     */
    protected array $headers;
    protected array $routes;

    protected string|null $token = null;

    /**
     * @param string $url
     * @param array $routes
     */
    public function __construct(string $url, array $routes)
    {
        $this->url = $url;
        $this->routes = $routes;
        $this->headers = [
            'Content-Type' => 'application/json',
            'Token' => $this->token ?? null
        ];
    }

    /**
     * @return string|null
     */
    public function requestToken(): string|null
    {
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['token']);

        if ($response['status']) {
            return $this->headers['Token'] = $response['body']['token'];
        }
        return null;
    }


    /**
     * @param UserStoreDTO $data
     * @return array|null
     */
    public function setUsers(UserStoreDTO $data): array|null
    {
        $this->requestToken();
        $this->headers['Content-Type'] = 'multipart/form-data';
        $response = HttpRequest::setHeaders($this->headers)
            ->post($this->url . $this->routes['users'], $data->toArray());
        dd($this->url . $this->routes['users'], $this->token,$response, $this->headers ,$data->toArray());
        return $response['status'] ? $response['body'] : null;
    }

    /**
     * @param GetUserDTO $data
     * @return array|null
     */
    public function getUsers(GetUserDTO $data): array|null
    {
        $this->requestToken();
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['users'], $data->toArray());
        return $response['status'] ? $response['body'] : null;
    }

    public function getUserById(int $id): array
    {
        return [];
    }

    /**
     * @return array|null
     */
    public function getPositions(): array|null
    {
        $this->requestToken();
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['positions']);
        return $response['status'] ? $response['body'] : null;
    }

}
