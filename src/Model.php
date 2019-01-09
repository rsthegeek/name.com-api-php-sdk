<?php

namespace lisi4ok\NameDotCom;

use GuzzleHttp\ClientInterface;
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

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}