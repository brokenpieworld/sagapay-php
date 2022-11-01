<?php

namespace sagapay\Withdraw;

use GuzzleHttp\Client;

/***
 * 
 *  Never call these functions from client view. Never expose the private key
 */

class Withdraw
{
    public $api_endpoint = 'https://app.sagapay.net/api/v2';

    /// Withdraw custom tokens
    public function withdrawToken($amount, $coin_code, $network, $smart_contract_address, $withdraw_address, $ipn_url, $public_key, $secret_key, $txn_no=null)
    {
        $client = new Client();
        $response = $client->post($this->api_endpoint.'/token-withdraw', [
            'form_params' => [
                'amount'           => $amount,
                'coin_code'        => $coin_code,
                'network'          => $network,
                'contract_address' => $smart_contract_address,
                'ipn_url'          => $ipn_url,
                'api_key'          => $public_key,
                'secret_key'       => $secret_key,
                'address'          => $withdraw_address,
                'txn_no'           => $txn_no,
            ],
        ]);

        $body = $response->getBody();
        return json_decode($body);
    }

    /// Withdraw listed coins
    public function withdraw($amount, $coin_code, $withdraw_address, $ipn_url, $public_key, $secret_key, $txn_no=null)
    {
        $client = new Client();
        $response = $client->post($this->api_endpoint.'/token-withdraw', [
            'form_params' => [
                'amount'           => $amount,
                'coin_code'        => $coin_code,
                'ipn_url'          => $ipn_url,
                'api_key'          => $public_key,
                'secret_key'       => $secret_key,
                'address'          => $withdraw_address,
                'txn_no'           => $txn_no,
            ],
        ]);

        $body = $response->getBody();
        return json_decode($body);
    }
}

