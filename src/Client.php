<?php

namespace lisi4ok\NameDotCom;

use GuzzleHttp\Client as GuzzleHttpClient;
use lisi4ok\NameDotCom\Contracts\ClientInterface;
use lisi4ok\NameDotCom\Contracts\ConfigurationInterface;
use lisi4ok\NameDotCom\Contracts\ModelInterface;

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
     * @param string $name
     * @return null|ModelInterface
     */
    public function __get(string $name): ModelInterface
    {
        if (method_exists(self::class, $name)) {
            return $this->{$name}();
        }
        return null;
    }

    /**
     * @return Domain
     */
    public function domain()
    {
        return (new Domain($this->client));
    }

    /**
     * @return DNS
     */
    public function dns()
    {
        return (new DNS($this->client));
    }

    /**
     * @return DNSSEC
     */
    public function dnssec()
    {
        return (new DNSSEC($this->client));
    }

    /**
     * @return URLForwarding
     */
    public function urlForwarding()
    {
        return (new URLForwarding($this->client));
    }

    /**
     * @return EmailForwarding
     */
    public function emailForwarding()
    {
        return (new EmailForwarding($this->client));
    }

    /**
     * @return Transfer
     */
    public function transfer()
    {
        return (new Transfer($this->client));
    }

    /**
     * @return VanityNameserver
     */
    public function vanityNameserver()
    {
        return (new VanityNameserver($this->client));
    }
}