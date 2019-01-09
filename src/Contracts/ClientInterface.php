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
     * @param array $configuration
     */
    public function __construct(array $configuration)

    /**
     * @return array
     */
    public function getConfiguration(): array

    /**
     * @param array $configuration
     * @return ClientInterface
     */
    public function setConfiguration(array $configuration): self
}