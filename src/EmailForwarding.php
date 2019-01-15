<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class EmailForwarding
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class EmailForwarding extends Model
{
    /**
     * @param string $domain
     * @param int|null $perPage
     * @param int|null $page
     * @return stdClass
     * @throws GuzzleException
     */
    public function list(string $domain, int $perPage = null, int $page = null)
    {
        $data = [];
        if ($perPage && $page) {
            $data = ['perPage' => $perPage, 'page' => $page];
        }

        return $this->get('domains/' . $domain . '/email/forwarding', $data);
    }

    /**
     * @param string $domain
     * @param string $emailBox EmailBox is the user portion of the email address to forward.
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain, string $emailBox)
    {
        return $this->get('domains/' . $domain . '/email/forwarding/' . $emailBox);
    }

    /**
     * @param string $domain
     * @param string $emailBox EmailBox is the user portion of the email address to forward.
     * @param string $emailTo  EmailTo is the entire email address to forward email to.
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, string $emailBox, string $emailTo)
    {
        return $this->post('domains/' . $domain . '/email/forwarding', [
            'emailBox' => $emailBox,
            'emailTo' => $emailTo,
        ]);
    }

    /**
     * @param string $domain
     * @param string $emailBox EmailBox is the user portion of the email address to forward.
     * @param string $emailTo  EmailTo is the entire email address to forward email to.
     * @return stdClass
     * @throws GuzzleException
     */
    public function update(string $domain, string $emailBox, string $emailTo)
    {
        return $this->put('domains/' . $domain . '/email/forwarding/' . $emailBox, ['emailTo' => $emailTo]);
    }

    /**
     * @param string $domain
     * @param string $emailBox EmailBox is the user portion of the email address to forward.
     * @return stdClass
     * @throws GuzzleException
     */
    public function remove(string $domain, string $emailBox)
    {
        return $this->delete('domains/' . $domain . '/email/forwarding/' . $emailBox);
    }
}