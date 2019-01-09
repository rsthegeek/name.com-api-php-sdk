<?php

namespace lisi4ok\NameDotCom;

use GuzzleHttp\Client as GuzzleHttpClient;
use lisi4ok\NameDotCom\Contracts\ClientInterface;
use lisi4ok\NameDotCom\Contracts\ConfigurationInterface;

/**
 * Class Client
 * @package lisi4ok\NameDotCom
 */
class Client implements ClientInterface
{
    /**
     * @var GuzzleHttpClient
     */
    private $client;

    /**
     * Client constructor.
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->client = new GuzzleHttpClient([
            'base_uri' => $configuration->getUri(),
            'auth' => [$configuration->getUsername(), $configuration->getToken()],
        ]);
    }

    /**
     * @return Domain
     */
    public function domain()
    {
        return (new Domain($this->client));
    }
}