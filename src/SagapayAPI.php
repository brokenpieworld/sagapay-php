<?php

namespace Sagapay;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SagapayAPI
{
    private $apiKey;
    private $secretKey;
    private $baseUrl = 'https://app.sagapay.net/api/v2';
    private $client;

    public function __construct($apiKey, $secretKey = null)
    {
        $this->apiKey    = $apiKey;
        $this->secretKey = $secretKey;
        $this->client    = new Client([
                                          'base_uri' => $this->baseUrl,
                                          'headers'  => [
                                              'Content-Type' => 'application/json',
                                          ],
                                      ]);
    }

    public function deposit($token_id, $amount, $ipn_url, $udf=null)
    {
        try {
            $response = $this->client->post('/deposit', [
                'json' => [
                    'api_key'  => $this->apiKey,
                    'token_id' => $token_id,
                    'ipn_url'  => $ipn_url,
                    'amount'   => $amount,
                    'udf'      => $udf,
                ],
            ]);

            return json_decode($response->getBody(), true);
        }
        catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function withdraw($token_id, $amount, $withdrawal_address, $ipn_url, $udf=null)
    {
        try {
            $response = $this->client->post('/withdraw', [
                'json' => [
                    'api_key'            => $this->apiKey,
                    'api_secret'         => $this->secretKey,
                    'ipn_url'            => $ipn_url,
                    'token_id'           => $token_id,
                    'amount'             => $amount,
                    'withdrawal_address' => $withdrawal_address,
                    'udf'                => $udf,
                ],
            ]);

            return json_decode($response->getBody(), true);
        }
        catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function checkBalance($token_id)
    {
        try {
            $response = $this->client->post('/check-balance', [
                'json' => [
                    'api_key'  => $this->apiKey,
                    'token_id' => $token_id,
                ],
            ]);

            return json_decode($response->getBody(), true);
        }
        catch (GuzzleException $e) {
            return json_decode($e->getResponse()->getBody(), true);
        }
    }

    public function validateIPN($request, $secretKey)
    {
        $payload           = json_encode($request->getContent());
        $receivedSignature = $request->headers->get('x-sagapay-ipn');
        $hmac              = hash_hmac('sha256', $payload, $secretKey);

        return $hmac === $receivedSignature;
    }
}
