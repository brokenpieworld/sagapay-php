# Sagapay API PHP Library

This is a PHP library for the Sagapay API. It allows you to easily interact with the Sagapay API to perform deposit, withdrawal, and balance check operations.

## Installation

You can install this package using Composer. Simply run the following command:

```bash
composer require brokenpieworld/sagapay
```

## Usage

### To use the Sagapay API PHP library, first create an instance of the SagapayAPI class, passing in your API key and secret key:

```bash
use Sagapay\SagapayAPI;

$apiKey = 'your-api-key';
$secretKey = 'your-secret-key';

$sagapayAPI = new SagapayAPI($apiKey, $secretKey);
```

### Once you have an instance of the SagapayAPI class, you can call its methods to interact with the Sagapay API:



```bash
$tokenID = 'BTC';
$amount = 1.0;
$udf = 'Order #123';

// Deposit funds
$response = $sagapayAPI->deposit($tokenID, $amount, $ipn_url, $udf);

// Withdraw funds
$withdrawalAddress = '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2';
$response = $sagapayAPI->withdraw($tokenID, $amount, $withdrawalAddress, $ipn_url, $udf);

// Check balance
$response = $sagapayAPI->checkBalance($tokenID);

// Validate IPN
if ($client->validateIPN($_POST, 'your_api_secret_key')) {
    // IPN is valid
} else {
    // IPN is invalid
}
```

### Never expose API secret key to the client side