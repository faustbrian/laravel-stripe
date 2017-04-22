<?php



declare(strict_types=1);



namespace BrianFaust\Stripe;

use Stripe\Stripe as SDK;

class Stripe
{
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
    }

    public function __call(string $method, array $arguments)
    {
        $sdkClass = substr($method, 3);

        if (class_exists($apiClass = "Stripe\\$sdkClass")) {
            return new $apiClass();
        }

        return forward_static_call_array([SDK::class, $method], $arguments);
    }
}
