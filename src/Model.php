<?php

namespace lisi4ok\NameDotCom;

use Exception;
use stdClass;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use lisi4ok\NameDotCom\Contracts\ModelInterface;

/**
 * Class Model
 * @package lisi4ok\NameDotCom
 */
abstract class Model implements ModelInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Model constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $data
     * @return stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException|Exception
     */
    protected function request($uri = '', $method = 'get', $data = []): stdClass
    {
        $method = strtolower($method);
        if ($method == 'options' || $method == 'head') {
            throw new Exception('Available Requests are: GET, POST, PUT, PATCH and DELETE');
        }

        $options = [];
        if (!empty($data)) {
            $options[RequestOptions::JSON] = $data;
        }

        try {
            /** @var ResponseInterface $response */
            $response = $this->client->request($method, $uri, $options);
        } catch (ClientException $e) {
            throw $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}