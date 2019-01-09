<?php

namespace lisi4ok\NameDotCom\Contracts;

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

//    public function list();
//
//    public function get();
//
//    public function create();
//
//    public function update();
//
//    public function delete();
}