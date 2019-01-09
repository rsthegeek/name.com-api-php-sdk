<?php

namespace lisi4ok\NameDotCom;

use Exception;

/**
 * Class Domain
 * @package lisi4ok\NameDotCom
 */
class Domain extends Model
{
    /**
     * @param  null|int $perPage
     * @param  null|int $page
     * @return mixed
     * @throws Exception
     */
    public function list(int $perPage = null, int $page = null)
    {
        $data = [];
        if ($perPage && $page) {
            $data = ['perPage' => $perPage, 'page' => $page];
        }

        return $this->request('domains', 'get', $data);
    }
}