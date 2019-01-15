<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class URLForwarding
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class URLForwarding extends Model
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

        return $this->get('domains/' . $domain . '/url/forwarding', $data);
    }

    /**
     * @param  string $domain
     * @param  string $host     Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                          domain would be "example.org" and host would be "blog". An apex record would be
     *                          specified by either an empty host "" or "@". A SRV record
     *                          would be specified by "_{service}._{protocal}.{host}":
     *                          e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                          Host can be "www", and domain fqdn will be: www.example.org.
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain, string $host)
    {
        return $this->get('domains/' . $domain . '/url/forwarding/' . $host);
    }

    /**
     * @param  string $domain
     *
     * @param  string $host       Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                            domain would be "example.org" and host would be "blog". An apex record would be
     *                            specified by either an empty host "" or "@". A SRV record
     *                            would be specified by "_{service}._{protocal}.{host}":
     *                            e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                            Host can be "www", and domain fqdn will be: www.example.org.
     *
     * @param  string $forwardsTo ForwardsTo is the URL this host will be forwarded to.
     *
     * @param  string $type       Type is the type of forwarding. Valid types are:
     *                            Masked - This retains the original domain in the address bar and will not reveal
     *                            or display the actual destination URL. If you are forwarding
     *                            knowledgebase.ninja to Name.com, the address bar will say knowledgebase.ninja.
     *                            This is sometimes called iframe forwarding.
     *                            And: Redirect - This does not retain the original domain in the address bar,
     *                            so the user will see it change and realize they were forwarded
     *                            from the URL they originally entered.
     *                            If you are forwarding knowledgebase.ninja to Name.com,
     *                            the address bar will say Name.com.
     *                            This is also called 301 forwarding.
     *
     * @param  string $title      Title is the title for the html page to use if the type is masked.
     *                            Values are ignored for types other then "masked".
     *
     * @param  string $meta       Meta is the meta tags to add to the html page if the type is masked.
     *                            ex: "meta name='keywords' content='fish, denver, platte'".
     *                            Values are ignored for types other then "masked".
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, string $host, string $forwardsTo,
                           string $type = '', string $title = '', string $meta = '')
    {
        $data = [
            'forwardsTo' => $forwardsTo,
            'host' => $host,
        ];
        if ($type) {
            $data['type'] = $type;
        }
        if ($title) {
            $data['title'] = $title;
        }
        if ($meta) {
            $data['meta'] = $meta;
        }

        return $this->post('domains/' . $domain . '/url/forwarding', $data);
    }

    /**
     * @param  string $domain
     *
     * @param  string $host       Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                            domain would be "example.org" and host would be "blog". An apex record would be
     *                            specified by either an empty host "" or "@". A SRV record
     *                            would be specified by "_{service}._{protocal}.{host}":
     *                            e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                            Host can be "www", and domain fqdn will be: www.example.org.
     *
     * @param  string $forwardsTo ForwardsTo is the URL this host will be forwarded to.
     *
     * @param  string $type       Type is the type of forwarding. Valid types are:
     *                            Masked - This retains the original domain in the address bar and will not reveal
     *                            or display the actual destination URL. If you are forwarding
     *                            knowledgebase.ninja to Name.com, the address bar will say knowledgebase.ninja.
     *                            This is sometimes called iframe forwarding.
     *                            And: Redirect - This does not retain the original domain in the address bar,
     *                            so the user will see it change and realize they were forwarded
     *                            from the URL they originally entered.
     *                            If you are forwarding knowledgebase.ninja to Name.com,
     *                            the address bar will say Name.com.
     *                            This is also called 301 forwarding.
     *
     * @param  string $title      Title is the title for the html page to use if the type is masked.
     *                            Values are ignored for types other then "masked".
     *
     * @param  string $meta       Meta is the meta tags to add to the html page if the type is masked.
     *                            ex: "meta name='keywords' content='fish, denver, platte'".
     *                            Values are ignored for types other then "masked".
     * @return stdClass
     * @throws GuzzleException
     */
    public function update(string $domain, string $host, string $forwardsTo,
                           string $type = '', string $title = '', string $meta = '')
    {
        $data = [
            'host' => $host,
            'forwardsTo' => $forwardsTo,
        ];
        if ($type) {
            $data['type'] = $type;
        }
        if ($title) {
            $data['title'] = $title;
        }
        if ($meta) {
            $data['meta'] = $meta;
        }

        return $this->put('domains/' . $domain . '/url/forwarding/' . $host, $data);
    }

    /**
     * @param  string $domain
     *
     * @param  string $host       Host is the hostname relative to the zone: e.g. for a record for blog.example.org,
     *                            domain would be "example.org" and host would be "blog". An apex record would be
     *                            specified by either an empty host "" or "@". A SRV record
     *                            would be specified by "_{service}._{protocal}.{host}":
     *                            e.g. "_sip._tcp.phone" for _sip._tcp.phone.example.org.
     *                            Host can be "www", and domain fqdn will be: www.example.org.
     * @return stdClass
     * @throws GuzzleException
     */
    public function remove(string $domain, string $host)
    {
        return $this->delete('domains/' . $domain . '/url/forwarding/' . $host);
    }
}