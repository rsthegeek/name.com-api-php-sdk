<?php

namespace lisi4ok\NameDotCom;

use stdClass;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Transfer
 * @package lisi4ok\NameDotCom
 * @method get(string $uri = '', array $data = [])
 * @method post(string $uri = '', array $data = [])
 * @method put(string $uri = '', array $data = [])
 * @method patch(string $uri = '', array $data = [])
 * @method delete(string $uri = '', array $data = [])
 */
class Transfer extends Model
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

        return $this->get('transfers', $data);
    }

    /**
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function find(string $domain)
    {
        return $this->get('transfers/' . $domain);
    }

    /**
     * @param string $domain
     *
     * @param string $authCode         AuthCode is the authorization code for the transfer.
     *                                 Not all TLDs require authorization codes, but most do.
     *
     * @param float $purchasePrice     PurchasePrice is the amount to pay for the transfer of the domain.
     *                                 If privacy_enabled is set, the regular price for Whois Privacy will be
     *                                 added automatically. If VAT tax applies, it will also be added automatically.
     *                                 PurchasePrice is required if the domain to transfer is a premium domain.
     *
     * @param bool $privacy            PrivacyEnabled is a flag on whether to purchase Whois Privacy with the transfer.
     *
     * @param string|null $promoCode
     *
     * @return stdClass
     * @throws GuzzleException
     */
    public function create(string $domain, string $authCode, float $purchasePrice, bool $privacy = false, string $promoCode = null)
    {
        $data = [
            'domainName' => $domain,
            'authCode' => $authCode,
            'purchasePrice' => $purchasePrice,
            'privacy' => $privacy,
        ];
        if ($promoCode) {
            $data['promoCode'] = $promoCode;
        }
        return $this->post('transfers', $data);
    }

    /**
     * @param string $domain
     * @return stdClass
     * @throws GuzzleException
     */
    public function cancel(string $domain)
    {
        return $this->post('transfers/' . $domain . ':cancel');
    }
}