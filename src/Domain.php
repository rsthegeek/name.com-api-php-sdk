<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Domain
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class Domain extends Model
{
    /**
     * @param int|null $perPage
     * @param int|null $page
     * @return stdClass
     * @throws GuzzleException
     */
    public function list(int $perPage = null, int $page = null)
    {
        $data = [];
        if ($perPage && $page) {
            $data = ['perPage' => $perPage, 'page' => $page];
        }

        return $this->get('domains', $data);
    }

    /**
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain)
    {
        return $this->get('domains/' . $domain);
    }

    /**
     * @param string $keyword
     * @param null|array $filter
     * @return stdClass
     * @throws GuzzleException
     */
    public function search(string $keyword, array $filter = null)
    {
        return $this->post('domains:search', ['keyword' => $keyword, 'tldFilter' => $filter]);
    }

    /**
     * @param string $domain
     * @param float|null $price
     * @param int $years
     * @param string $purchaseType
     * @param null|string|array $tldRequirements
     * @param string|null $promoCode
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, float $price = null, int $years = 1,
                           string $purchaseType = 'registration', $tldRequirements = null, string $promoCode = null)
    {
        $data = [
            'domain' => [
                'domainName' => $domain,
            ],
            'years' => $years,
            'purchaseType' => $purchaseType,
        ];
        if ($price) {
            $data['purchasePrice'] = $price;
        }
        if ($tldRequirements) {
            $data['tldRequirements'] = $tldRequirements;
        }
        if ($promoCode) {
            $data['promoCode'] = $promoCode;
        }

        return $this->post('domains', $data);
    }

    /**
     * @param string $domain
     * @param float|null $price
     * @param int $years
     * @param string|null $promoCode
     * @return stdClass
     * @throws GuzzleException
     */
    public function renew(string $domain, float $price = null, int $years = 1, string $promoCode = null)
    {
        $data = [];
        if ($price) {
            $data['purchasePrice'] = (float)number_format(
                floor($price * 100) / 100, 2, '.', ''
            );
        }
        $data['years'] = $years;
        if ($promoCode) {
            $data['promoCode'] = $promoCode;
        }

        return $this->post('domains/' . $domain . ':renew', $data);
    }

    /**
     * @param string $domain
     * @param array $nameservers
     * @return stdClass
     * @throws GuzzleException
     */
    public function setNameservers(string $domain, array $nameservers)
    {
        return $this->post('domains/' . $domain . ':setNameservers', ['nameservers' => $nameservers]);
    }

    /**
     * registrant, admin, tech, billing = {
     *     firstName,
     *     lastName,
     *     address1,
     *     city,
     *     state,
     *     country,
     *     phone,
     * }
     * * Data for the different users
     * * The "country" key is CountryCode
     *
     * @param string $domain
     * @param array $registrant
     * @param array $admin
     * @param array $tech
     * @param array $billing
     * @return stdClass
     * @throws GuzzleException
     */
    public function setContacts(string $domain, array $registrant, array $admin, array $tech, array $billing)
    {
        return $this->post('domains/' . $domain . ':setContacts', [
            'contacts' => [
                'registrant' => $registrant,
                'admin' => $admin,
                'tech' => $tech,
                'billing' => $billing,
            ],
        ]);
    }

    /**
     * @param string $domain
     * @param float $price
     * @param int $years
     * @param string|null $promoCode
     * @return stdClass
     * @throws GuzzleException
     */
    public function privacy(string $domain, float $price, int $years = 1, string $promoCode = null)
    {
        $data = [
            'purchasePrice' => $price,
            'years' => $years,
        ];
        if ($promoCode) {
            $data['promoCode'] = $promoCode;
        }

        return $this->post('domains/' . $domain . ':purchasePrivacy', $data);
    }

    /**
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function enableAutorenew(string $domain)
    {
        return $this->post('domains/' . $domain . ':enableAutorenew');
    }

    /**
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function disableAutorenew(string $domain)
    {
        return $this->post('domains/' . $domain . ':disableAutorenew');
    }

    /**
     * @param array $domains
     * @return stdClass
     * @throws GuzzleException
     */
    public function lock(string $domain)
    {
        return $this->post('domains/' . $domain . ':lock');
    }

    /**
     * @param array $domains
     * @return stdClass
     * @throws GuzzleException
     */
    public function unlock(string $domain)
    {
        return $this->post('domains/' . $domain . ':unlock');
    }

    /**
     * @param array $domains
     * @return stdClass
     * @throws GuzzleException
     */
    public function getAuthCode(string $domain)
    {
        return $this->get('domains/' . $domain . ':getAuthCode');
    }

    /**
     * @param array $domains
     * @return stdClass
     * @throws GuzzleException
     */
    public function checkAvailability(array $domains)
    {
        return $this->post('domains:checkAvailability', ['domainNames' => $domains]);
    }
}