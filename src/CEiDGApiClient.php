<?php

declare(strict_types=1);


namespace Opal\OpalCeidg;


use GuzzleHttp\Client;
use Opal\OpalCeidg\Dto\Address;
use Opal\OpalCeidg\Dto\Company;
use Opal\OpalCeidg\Dto\Owner;
use Opal\OpalCeidg\Exceptions\CEiDGResponseException;
use Opal\OpalCeidg\Exceptions\CEiDGResponseParsingException;
use Opal\OpalCeidg\Filters\CompanyFilter;

class CEiDGApiClient
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function company(CompanyFilter $filter)
    {
        $query = [];

        if($filter->getNip()) {
            $query['nip'] = $filter->getNip();
        }

        $response = $this
            ->httpClient
            ->get('firma', ['query' => $query]);

        switch($response->getStatusCode()) {
            case 200:

                $rawResponse = $response->getBody()->getContents();
                $decoded = json_decode($rawResponse, true);

                if($decoded === -1) {
                    throw new CEiDGResponseParsingException(trans('ceidg::errors.response_parsing_error'));
                }

                $companyData = $decoded['firma'][0];

                return new Company(
                    $companyData['id'],
                    $companyData['nazwa'],
                    new Owner(
                        $companyData['wlasciciel']['imie'],
                        $companyData['wlasciciel']['nazwisko'],
                        $companyData['wlasciciel']['nip'],
                        $companyData['wlasciciel']['regon'],
                    ),
                    new Address(
                        $companyData['adresKorespondencyjny']['ulica'],
                        $companyData['adresKorespondencyjny']['budynek'],
                        $companyData['adresKorespondencyjny']['miasto'],
                        $companyData['adresKorespondencyjny']['wojewodztwo'],
                        $companyData['adresKorespondencyjny']['powiat'],
                        $companyData['adresKorespondencyjny']['gmina'],
                        $companyData['adresKorespondencyjny']['kraj']
                    )
                );
            case 204:
            case 400:
            case 401:
            case 403:
            case 404:
            case 429:
            case 500:
                throw new CEiDGResponseException(
                    trans("ceidg::responses.{$response->getStatusCode()}"),
                    $response->getStatusCode()
                );
        }
    }
}