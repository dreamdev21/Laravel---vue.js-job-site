<?php

namespace App\TheBetaPlan\Payments;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class Gateway
{
    public static function paypal()
    {
        $config = config('paypal');
        $apiContext = new ApiContext(
      new OAuthTokenCredential($config['client_id'], $config['client_secret'])
    );
        $apiContext->setConfig(array_merge(['mode' => $config['mode']], array_dot(['log' => $config['log']])));
        return $apiContext;
    }
}
