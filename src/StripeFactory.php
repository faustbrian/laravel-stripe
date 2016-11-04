<?php

namespace BrianFaust\Stripe;

use InvalidArgumentException;
// use Stripe\Stripe;

class StripeFactory
{
    /**
     * Make a new Stripe client.
     *
     * @param array $config
     *
     * @return \Stripe\Stripe
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        $keys = ['key'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, ['key']);
    }

    /**
     * Get the Stripe client.
     *
     * @param array $auth
     *
     * @return \Stripe\Stripe
     */
    protected function getClient(array $auth)
    {
        return new Stripe($auth['key']);
    }
}
