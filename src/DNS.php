<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class DNS
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class DNS extends Model
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

        return $this->get('domains/' . $domain . '/records', $data);
    }

    /**
     * @param string $domain
     * @param int $id
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain, int $id)
    {
        return $this->get('domains/' . $domain . '/records/' . $id);
    }

    /**
     * @param  string $domain
     * @param  string $type       Type is one of the following: A, AAAA, ANAME, CNAME, MX, NS, SRV, or TXT.
     *
     * @param  string $answer     Answer is either the IP address for A or AAAA records; the target for
     *                            ANAME, CNAME, MX, or NS records; the text for TXT records.
     *                            For SRV records, answer has the following format:
     *                            "{weight} {port} {target}" e.g. "1 5061 sip.example.org".
     *
     * @param  string $host       Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                            domain would be "example.org" and host would be "blog". An apex record would be
     *                            specified by either an empty host "" or "@". A SRV record
     *                            would be specified by "_{service}._{protocal}.{host}":
     *                            e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                            Host can be "www", and domain fqdn will be: www.example.org.
     *
     * @param  null|int $ttl      TTL is the time this record can be cached for in seconds.
     *                            Name.com allows a minimum TTL of 300, or 5 minutes.
     *
     * @param  null|int $priority Priority is only required for MX and SRV records, it is ignored for all others.
     *
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, string $type, string $answer, string $host = '',
                           int $ttl = null, $priority = null)
    {
        $data = [
            'type' => $type,
            'answer' => $answer,
        ];
        if ($host) {
            $data['host'] = $host;
        } else {
            $data['host'] = '';
        }
        if ($ttl) {
            $data['ttl'] = $ttl;
        }
        if ($priority) {
            $data['priority'] = $priority;
        }

        return $this->post('domains/' . $domain . '/records', $data);
    }

    /**
     * @param  int    $id
     * @param  string $domain
     * @param  string $type       Type is one of the following: A, AAAA, ANAME, CNAME, MX, NS, SRV, or TXT.
     *
     * @param  string $answer     Answer is either the IP address for A or AAAA records; the target for
     *                            ANAME, CNAME, MX, or NS records; the text for TXT records.
     *                            For SRV records, answer has the following format:
     *                            "{weight} {port} {target}" e.g. "1 5061 sip.example.org".
     *
     * @param  string $host       Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                            domain would be "example.org" and host would be "blog". An apex record would be
     *                            specified by either an empty host "" or "@". A SRV record
     *                            would be specified by "_{service}._{protocal}.{host}":
     *                            e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                            Host can be "www", and domain fqdn will be: www.example.org.
     *
     * @param  null|int $ttl      TTL is the time this record can be cached for in seconds.
     *                            Name.com allows a minimum TTL of 300, or 5 minutes.
     *
     * @param  null|int $priority Priority is only required for MX and SRV records, it is ignored for all others.
     *
     * @return stdClass
     * @throws GuzzleException
     */
    public function update(int $id, string $domain, string $type, string $answer, string $host = '',
                           int $ttl = null, $priority = null)
    {
        $data = [
            'type' => $type,
            'answer' => $answer,
        ];
        if ($host) {
            $data['host'] = $host;
        } else {
            $data['host'] = '';
        }
        if ($ttl) {
            $data['ttl'] = $ttl;
        }
        if ($priority) {
            $data['priority'] = $priority;
        }

        return $this->put('domains/' . $domain . '/records/' . $id, $data);
    }

    /**
     * @param int $id
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function remove(int $id, string $domain)
    {
        return $this->delete('domains/' . $domain . '/records/' . $id);
    }
}