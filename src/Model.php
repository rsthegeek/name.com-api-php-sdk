<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use BadMethodCallException;
use InvalidArgumentException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use lisi4ok\NameDotCom\Contracts\ModelInterface;

/**
 * Class Model
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
abstract class Model implements ModelInterface
{
    /**
     * @var array
     */
    private static $methods = ['get', 'post', 'put', 'patch', 'delete'];

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
     * @param $name
     * @param $arguments
     * @return stdClass
     * @throws BadMethodCallException
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        if (!in_array($name, self::$methods)) {
            throw new BadMethodCallException;
        }
        if (!array_key_exists(0, $arguments) || !is_string($arguments[0])) {
            throw new InvalidArgumentException;
        }

        if (array_key_exists(1, $arguments)) {
            if (!is_array($arguments[1])) {
                throw new InvalidArgumentException;
            }

            return $this->request($arguments[0], $name, $arguments[1]);
        }

        return $this->request($arguments[0], $name);
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $data
     * @return stdClass
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    protected function request(string $uri = '', string $method = 'get', array $data = []): stdClass
    {
        $method = strtolower($method);
        if (!$uri || !in_array($method, self::$methods)) {
            throw new InvalidArgumentException;
        }

        $options = [];
        if (!empty($data)) {
            $options[RequestOptions::JSON] = $data;
        }

        try {
            $response = $this->client->request($method, urlencode($uri), $options);
        } catch (ClientException $e) {
            throw $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}
