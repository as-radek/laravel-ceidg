<?php

declare(strict_types=1);

namespace Opal\OpalCeidg;

class EnvironmentManager
{
    /**
     * string
     */
    const PROD_BASE_URL = "https://dane.biznes.gov.pl/api/ceidg/v2/";

    /**
     * string
     */
    const TEST_BASE_URL = "https://test-dane.biznes.gov.pl/api/ceidg/v2/";

    public static function getBaseUrl(bool $testMode): string
    {
        return $testMode ? self::TEST_BASE_URL : self::PROD_BASE_URL;
    }
}