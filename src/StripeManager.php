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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class StripeManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \BrianFaust\Stripe\StripeFactory
     */
    private $factory;

    /**
     * Create a new Stripe manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \BrianFaust\Stripe\StripeFactory        $factory
     */
    public function __construct(Repository $config, StripeFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'stripe';
    }

    /**
     * Get the factory instance.
     *
     * @return \BrianFaust\Stripe\StripeFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
