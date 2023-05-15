<?php

namespace Sagapay;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class SagapayAPI
{
    private $apiKey;
    private $secretKey;
    private $baseUrl = 'https://app.sagapay.net';
    private $client;

    public function __construct($apiKey, $secretKey = null)
    {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function deposit($token_id, $amount, $ipn_url, $udf = null)
    {
        echo 'working here<br/>';
        try {
            $response = $this->client->post('/api/v2/deposit', [
                'json' => [
                    'api_key' => $this->apiKey,
                    'token_id' => $token_id,
                    'ipn_url' => $ipn_url,
                    'amount' => $amount,
                    'udf' => $udf,
                ],
            ]);
var_dump($response);
            echo 'working here too<br/>';
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {

           var_dump($e->getMessage());
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function withdraw($token_id, $amount, $withdrawal_address, $ipn_url, $udf = null)
    {
        try {
            $response = $this->client->post('/api/v2/withdraw', [
                'json' => [
                    'api_key' => $this->apiKey,
                    'api_secret' => $this->secretKey,
                    'ipn_url' => $ipn_url,
                    'token_id' => $token_id,
                    'amount' => $amount,
                    'withdrawal_address' => $withdrawal_address,
                    'udf' => $udf,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function checkBalance($token_id)
    {
        try {
            $response = $this->client->post('/api/v2/check-balance', [
                'json' => [
                    'api_key' => $this->apiKey,
                    'token_id' => $token_id,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function validateIPN($request, $secretKey)
    {
        $payload = json_encode($request->getContent());
        $receivedSignature = $request->headers->get('x-sagapay-ipn');
        $hmac = hash_hmac('sha256', $payload, $secretKey);

        return $hmac === $receivedSignature;
    }
}
