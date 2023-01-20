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
        $query = [
            'status' => [
                'AKTYWNY',
                'WYLACZNIE_W_FORMIE_SPOLKI'
            ]
        ];

        if($filter->getNip()) {
            $query['nip'][] = $filter->getNip();
        }

        $response = $this
            ->httpClient
            ->get('firmy', ['query' => $query]);

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
                        data_get($companyData, 'wlasciciel.imie'),
                        data_get($companyData, 'wlasciciel.nazwisko'),
                        data_get($companyData, 'wlasciciel.nip'),
                        data_get($companyData, 'wlasciciel.regon'),
                    ),
                    new Address(
                        data_get($companyData, 'adresDzialalnosci.budynek', data_get($companyData, 'adresKorespondencyjny.budynek')),
                        data_get($companyData, 'adresDzialalnosci.miasto', data_get($companyData, 'adresKorespondencyjny.miasto')),
                        data_get($companyData, 'adresDzialalnosci.wojewodztwo', data_get($companyData, 'adresKorespondencyjny.wojewodztwo')),
                        data_get($companyData, 'adresDzialalnosci.powiat', data_get($companyData, 'adresKorespondencyjny.powiat')),
                        data_get($companyData, 'adresDzialalnosci.gmina', data_get($companyData, 'adresKorespondencyjny.gmina')),
                        data_get($companyData, 'adresDzialalnosci.kraj', data_get($companyData, 'adresKorespondencyjny.kraj')),
                        data_get($companyData, 'adresDzialalnosci.ulica', data_get($companyData, 'adresKorespondencyjny.ulica')),
                        data_get($companyData, 'adresDzialalnosci.kod', data_get($companyData, 'adresKorespondencyjny.kod'))
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