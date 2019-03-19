<?php

namespace lisi4ok\NameDotCom\Contracts;

interface ConfigurationInterface
{
    /**
     * ConfigurationInterface constructor.
     * @param string $mode
     * @param int $apiVersion
     * @param string $username
     * @param string $token
     */
    public function __construct(string $mode, int $apiVersion, string $username, string $token);

    /**
     * @return string
     */
    public function getUri(): string;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @return string
     */
    public function getToken(): string;
}