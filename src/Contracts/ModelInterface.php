<?php

namespace lisi4ok\NameDotCom\Contracts;

use stdClass;
use BadMethodCallException;
use InvalidArgumentException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\ClientInterface;

/**
 * Interface ModelInterface
 * @package lisi4ok\NameDotCom
 */
interface ModelInterface
{
    /**
     * ClientInterface constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client);

    /**
     * @param $name
     * @param $arguments
     * @return stdClass
     * @throws BadMethodCallException
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    public function __call($name, $arguments);

//    /**
//     * @param int|null $perPage
//     * @param int|null $page
//     * @return stdClass
//     * @throws GuzzleException
//     */
//    public function list(int $perPage = null, int $page = null);
//
//    /**
//     * @param string $name
//     * @return stdClass
//     * @throws GuzzleException
//     */
//    public function find(string $name): stdClass;
//
//    /**
//     * @param int $id
//     * @param string $name
//     * @param array $parameters
//     * @return stdClass
//     * @throws GuzzleException
//     */
//    public function update(int $id, string $name, array $parameters): stdClass;
//
//    /**
//     * @param int $id
//     * @param string $name
//     * @return stdClass
//     * @throws GuzzleException
//     */
//    public function delete(int $id, string $name): stdClass;

}