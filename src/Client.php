<?php

namespace lisi4ok\NameDotCom;

use lisi4ok\NameDotCom\Contracts\ClientInterface;

/**
 * Class Client
 * @package lisi4ok\NameDotCom
 */
class Client implements ClientInterface
{
    /**
     * @var null|array
     */
    private $configuration;

    /**
     * Client constructor.
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     * @return ClientInterface
     */
    public function setConfiguration(array $configuration): ClientInterface
    {
        $this->configuration = $configuration;
        return $this;
    }
}