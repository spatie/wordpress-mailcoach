<?php

namespace Spatie\WordPressMailcoach\Admin\Action;

use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;
use Spatie\WordPressMailcoach\Admin\Settings;

class StoreSettings
{
    public function execute(StoreSettingsData $data): void
    {
        if ($data->apiToken) {
            $storedApiToken = get_option(Settings::API_TOKEN);

            if (! empty($data->apiToken) && ! empty($storedApiToken)) {
                if (
                    ! $this->lastCharsAreEqual($data->apiToken, $storedApiToken)
                    && ! $this->containsAsterixSymbols($data->apiToken)
                ) {
                    update_option(Settings::API_TOKEN, $data->apiToken);
                }
            } else {
                add_option(Settings::API_TOKEN, $data->apiToken);
            }
        }

        if ($data->apiEndpoint) {
            $storedApiEndpoint = get_option(Settings::API_ENDPOINT);

            if (! empty($data->apiEndpoint) && ! empty($storedApiEndpoint)) {
                update_option(Settings::API_ENDPOINT, $data->apiEndpoint);
            } else {
                add_option(Settings::API_ENDPOINT, $data->apiEndpoint);
            }
        }
    }

    private function lastCharsAreEqual(string $original, string $given): bool
    {
        $given = substr($given, -4);
        $original = substr($original, -4);

        return substr($given, -4) === substr($original, -4);
    }

    private function containsAsterixSymbols(string $input): bool
    {
        return str_contains($input, '*');
    }
}
