<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class DNSSEC
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class DNSSEC extends Model
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

        return $this->get('domains/' . $domain . '/dnssec', $data);
    }

    /**
     * @param string $domain
     * @param string $digest
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain, string $digest)
    {
        return $this->get('domains/' . $domain . '/dnssec/' . $digest);
    }

    /**
     * @param string $domain
     *
     * @param int $keyTag      KeyTag contains the key tag value of the DNSKEY RR that validates this signature.
     *                         The algorithm to generate it is here:
     *                         https://tools.ietf.org/html/rfc4034#appendix-B
     *
     * @param int $algorithm   Algorithm is an integer identifying the algorithm used for signing.
     *                         Valid values can be found here:
     *                         https://www.iana.org/assignments/dns-sec-alg-numbers/dns-sec-alg-numbers.xhtml
     *
     * @param int $digestType  DigestType is an integer identifying the algorithm used to create the digest.
     *                         Valid values can be found here:
     *                         https://www.iana.org/assignments/ds-rr-types/ds-rr-types.xhtml
     *
     * @param string $digest   Digest is a digest of the DNSKEY RR that is registered with the registry.
     *
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, int $keyTag, int $algorithm, int $digestType, string $digest)
    {
        return $this->post('domains/' . $domain . '/dnssec', [
            'keyTag' => $keyTag,
            'algorithm' => $algorithm,
            'digestType' => $digestType,
            'digest' => $digest,
        ]);
    }

    /**
     * @param string $domain
     * @param string $digest
     * @return stdClass
     * @throws GuzzleException
     */
    public function remove(string $domain, string $digest)
    {
        return $this->delete('domains/' . $domain . '/dnssec/' . $digest);
    }
}