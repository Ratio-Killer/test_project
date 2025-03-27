<?php

namespace App\Services;

use App\DataTransferObjects\User\GetUsersDTO;
use App\DataTransferObjects\User\UserStoreDTO;
use App\Facades\HttpRequest;
use App\Traits\Image\ImageTrait;
use App\Contracts\Services\AbzApiServiceContract;

class AbzApiService implements AbzApiServiceContract
{
    use ImageTrait;

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
            'Token' => $this->token ?? null
        ];
    }

    /**
     * @return string|null
     */
    public function requestToken(): string|null
    {
        $response = HttpRequest::setHeaders(['Content-Type' => 'application/json'])
            ->get($this->url . $this->routes['token']);
        if ($response['status']) {
            return $this->token = $this->headers['Token'] = $response['body']['token'];
        }
        return null;
    }


    /**
     * @param UserStoreDTO $data
     * @return array
     */
    public function setUser(UserStoreDTO $data): array
    {
        $this->requestToken();
        $data->photo = $this->processImage($data->photo);
        $response = HttpRequest::setHeaders($this->headers)
            ->post($this->url . $this->routes['users'], $data->toArray());
        return $response['status'] ? $response['body'] : ['status' => false];
    }

    /**
     * @param GetUsersDTO $data
     * @return array
     */
    public function getUsers(GetUsersDTO $data): array
    {
        $this->requestToken();
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['users'], $data->toArray());
        return $response['status'] ? $response['body'] : ['status' => false];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUserById(int $id): array
    {
        $this->requestToken();
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['users'] . '/' . $id);
        return $response['status'] ? $response['body'] : ['status' => false];
    }

    /**
     * @return array
     */
    public function getPositions(): array
    {
        $this->requestToken();
        $response = HttpRequest::setHeaders($this->headers)
            ->get($this->url . $this->routes['positions']);
        return $response['status'] ? $response['body'] : ['status' => false];
    }

}
