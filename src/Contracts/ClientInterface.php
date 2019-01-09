<?php

namespace lisi4ok\NameDotCom\Contracts;

/**
 * Interface ClientInterface
 * @package lisi4ok\NameDotCom
 */
interface ClientInterface
{
    /**
     * ClientInterface constructor.
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration);
}