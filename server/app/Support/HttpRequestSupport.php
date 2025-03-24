<?php

namespace App\Support;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

            if (strtoupper($method) === 'GET') {
                $response = $request->get($url, $parameters);
            } else {
                $request = $request->asMultipart();
                $multipartData = [];

                foreach ($parameters as $key => $value) {
                    if ($key !== 'photo') {
                        $multipartData[$key] = is_array($value) ? json_encode($value) : $value;
                    }
                }

                if (!empty($parameters['photo']) && $parameters['photo'] instanceof UploadedFile) {
                    $photo = $parameters['photo'];
                    $request = $request->attach(
                        'photo',
                        file_get_contents($photo->getRealPath()),
                        $photo->getClientOriginalName(),
                        ['Content-Type' => $photo->getMimeType()]
                    );
                }

                $response = $request->post($url, $multipartData);
            }

            return $this->getBody($response);
        } catch (Exception $e) {
            Log::error('handleRequest Error: ' . $e->getMessage());
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
