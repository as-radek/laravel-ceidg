<?php

declare(strict_types=1);

namespace Opal\OpalCeidg\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Opal\OpalCeidg\CEiDGApiClient;
use Opal\OpalCeidg\EnvironmentManager;

class OpalCeidgProvider extends ServiceProvider
{
    public function boot()
    {
        $this
            ->publishes(
                [
                    __DIR__ . '/../config/config.php' => config_path('ceidg/config.php')
                ],
                'laravel-ceidg-config'
            );

        $this
            ->mergeConfigFrom(__DIR__ . "/../config/config.php", 'ceidg');

        $this
            ->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang/vendor/ceidg')
            ],
                'laravel-ceidg-translations'
        );

        $this
            ->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'ceidg');
    }

    public function register()
    {
        $this
            ->app
            ->bind(CEiDGApiClient::class, function($app) {
                return new CEiDGApiClient(
                    new Client([
                        'base_uri' => EnvironmentManager::getBaseUrl(config('ceidg.config.test_mode')),
                        'headers' => [
                            'Authorization' => "Bearer " . config('ceidg.config.auth_token')
                        ]
                    ])
                );
            });
    }
}