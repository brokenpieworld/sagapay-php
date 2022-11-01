### Installation

**Run in Terminal: `composer require sagapay/sagapay`**

## How to Deposit
` Import Package First`
use sagapay\Deposit\Deposit;
` Then initiate`
 $new_saga   = new Deposit();
` Then deposit..`
##### To Deposit Token:
```php
 $resp       = $new_saga->depostToken($amount, 'SAGA', 'BNB.BEP20', '0xJKJHJKH7667', 'https://domain.co/ipn', 'public_key');
var_dump($resp);
```
