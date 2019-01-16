<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class VanityNameserver
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class VanityNameserver extends Model
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

        return $this->get('domains/' . $domain . '/vanity_nameservers', $data);
    }

    /**
     * @param  string $domain
     * @param  string $hostname Hostname is the hostname for the vanity nameserver.
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain, string $hostname)
    {
        return $this->get('domains/' . $domain . '/vanity_nameservers/' . $hostname);
    }

    /**
     * @param string $domain
     * @param string $hostname Hostname is the hostname of the nameserver.
     * @param array $ips       IPs is a list of IP addresses that are used for glue records for this nameserver.
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, string $hostname, array $ips = [])
    {
        $data = ['hostname' => $hostname];
        if (!empty($ips)) {
            $data['ips'] = $ips;
        }

        return $this->post('domains/' . $domain . '/vanity_nameservers', $data);
    }

    /**
     * @param string $domain
     * @param string $hostname Hostname is the hostname of the nameserver.
     * @param array $ips       IPs is a list of IP addresses that are used for glue records for this nameserver.
     * @return stdClass
     * @throws GuzzleException
     */
    public function update(string $domain, string $hostname, array $ips = [])
    {
        $data = [];
        if (!empty($ips)) {
            $data['ips'] = $ips;
        }

        return $this->put('domains/' . $domain . '/vanity_nameservers/' . $hostname, (object) $data);
    }

    /**
     * @param  string $domain
     * @param  string $hostname Hostname is the hostname for the vanity nameserver.
     * @return stdClass
     * @throws GuzzleException
     */
    public function remove(string $domain, string $hostname)
    {
        return $this->delete('domains/' . $domain . '/vanity_nameservers/' . $hostname);
    }
}