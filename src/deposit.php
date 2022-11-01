<?php

namespace sagapay\Deposit;

use GuzzleHttp\Client;


class Deposit
{
    public $api_endpoint = 'https://app.sagapay.net/api/v2';

    /// Deposit custom tokens
    public function depositToken($amount, $coin_code, $network, $smart_contract_address, $ipn_url, $public_key, $txn_no=null, $customer_email=null)
    {
        $client = new Client();
        $response = $client->post($this->api_endpoint.'/token-deposit', [
            'form_params' => [
                'amount'           => $amount,
                'coin_code'        => $coin_code,
                'network'          => $network,
                'contract_address' => $smart_contract_address,
                'ipn_url'          => $ipn_url,
                'api_key'          => $public_key,
                'txn_no'           => $txn_no,
                'customer_email'   => $customer_email,
            ],
        ]);

        $body = $response->getBody();
        return json_decode($body);
    }


     /// Deposit listed coins
     public function deposit($amount, $coin_code, $ipn_url, $public_key, $txn_no=null, $customer_email=null)
     {
         $client = new Client();
         $response = $client->post($this->api_endpoint.'/token-deposit', [
             'form_params' => [
                 'amount'           => $amount,
                 'coin_code'        => $coin_code,
                 'ipn_url'          => $ipn_url,
                 'api_key'          => $public_key,
                 'txn_no'           => $txn_no,
                 'customer_email'   => $customer_email,
             ],
         ]);

         $body = $response->getBody();
         return json_decode($body);
     }
}

