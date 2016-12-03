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

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $source = realpath(__DIR__.'/../config/stripe.php');

        $this->publishes([$source => config_path('stripe.php')]);

        $this->mergeConfigFrom($source, 'stripe');
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     */
    protected function registerFactory()
    {
        $this->app->singleton('stripe.factory', function () {
            return new StripeFactory();
        });

        $this->app->alias('stripe.factory', StripeFactory::class);
    }

    /**
     * Register the manager class.
     */
    protected function registerManager()
    {
        $this->app->singleton('stripe', function (Container $app) {
            $config = $app['config'];
            $factory = $app['stripe.factory'];

            return new StripeManager($config, $factory);
        });

        $this->app->alias('stripe', StripeManager::class);
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        $this->app->bind('stripe.connection', function (Container $app) {
            $manager = $app['stripe'];

            return $manager->connection();
        });

        $this->app->alias('stripe.connection', Stripe::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'stripe',
            'stripe.factory',
            'stripe.connection',
        ];
    }
}
