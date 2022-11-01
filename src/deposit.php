<?php

namespace sagapay\Deposit;

use GuzzleHttp\Client;

class Deposit
{
    public function depostToken($amount, $coin_code, $network, $smart_contract_address, $ipn_url, $api_key)
    {
        $client = new Client();
        $response = $client->post('https://api.sagapay.net/v2/token-deposit', [
            'form_params' => [
                'amount'           => $amount,
                'coin_code'        => $coin_code,
                'network'          => $network,
                'contract_address' => $smart_contract_address,
                'ipn_url'          => $ipn_url,
                'api_key'          => $api_key,
            ],
        ]);

        $body = $response->getBody();
        return $body->getContents();
    }
}

