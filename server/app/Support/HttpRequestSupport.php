<?php

namespace App\Support;

use Exception;
use Illuminate\Support\Facades\Http;

class HttpRequestSupport
{
    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * Make a GET request.
     *
     * @param string $url
     * @param array $parameters
     * @return array|mixed
     */
    public function get(string $url, array $parameters = []): mixed
    {
        return $this->handleRequest('get', $url, $parameters);
    }

    /**
     * Make a POST request.
     *
     * @param string $url
     * @param array $parameters
     * @return array|mixed
     */
    public function post(string $url, array $parameters = []): mixed
    {
        return $this->handleRequest('post', $url, $parameters);
    }

    /**
     * Handle the HTTP request.
     *
     * @param string $method
     * @param string $url
     * @param array $parameters
     * @return array|mixed
     */
    private function handleRequest(string $method, string $url, array $parameters = []): mixed
    {
        try {
            $request = Http::withHeaders($this->headers);

            if (array_key_exists('body', $parameters)) {
                $request = $request->withBody($parameters['body']);
                unset($parameters['body']);
            }

            if (array_key_exists('form_params', $parameters)) {
                $request = $request->asForm();
                $parameters = $parameters['form_params'];
                unset($parameters['form_params']);
            }

            if (array_key_exists('attach', $parameters)) {
                $attach_data = $parameters['attach']['file'];
                $request = $request->attach($attach_data['name'], $attach_data['contents'], $attach_data['filename']);
                $parameters = $parameters['attach']['parameters'] ?? [];
                unset($parameters['attach']);
            }

            $response = $request->$method($url, $parameters);
            return $this->getBody($response);
        } catch (Exception) {
            return [];
        }
    }

    /**
     * @param $response
     * @return array
     */
    private function getBody($response): array
    {
        return [
            'status' => $response->successful(),
            'body' => $response->successful() ? ($response->json() ?: $response->body()) : []
        ];
    }

    /**
     * @param array $headers
     * @return HttpRequestSupport
     */
    public function setHeaders(array $headers): HttpRequestSupport
    {
        $this->headers = $headers;
        return $this;
    }
}
