<?php

/*
 * This file is part of Laravel Stripe.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Stripe.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
