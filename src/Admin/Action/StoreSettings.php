<?php

namespace Spatie\WordPressMailcoach\Admin\Action;

use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;

class StoreSettings
{
    public function execute(StoreSettingsData $data)
    {
        if ($data->apiToken) {
            $storedApiToken = get_option('mailcoach_api_token');

            if (! empty($data->apiToken) && ! empty($storedApiToken)) {
                if (
                    ! $this->lastCharsAreEqual($data->apiToken, $storedApiToken)
                    && ! $this->containsAsterixSymbols($data->apiToken)
                ) {
                    update_option('mailcoach_api_token', $data->apiToken);
                }
            } else {
                add_option('mailcoach_api_token', $data->apiToken);
            }
        }

        if ($data->apiEndpoint) {
            $storedApiEndpoint = get_option('mailcoach_api_endpoint');

            if (! empty($data->apiEndpoint) && ! empty($storedApiEndpoint)) {
                update_option('mailcoach_api_endpoint', $data->apiEndpoint);
            } else {
                add_option('mailcoach_api_endpoint', $data->apiEndpoint);
            }
        }
    }

    private function lastCharsAreEqual(string $original, string $given): bool
    {
        $given = substr($given, -4);
        $original = substr($original, -4);

        return substr($given, -4) === substr($original, -4);
    }
}
    private function containsAsterixSymbols(string $input): bool
    {
        return str_contains($input, '*');
    }
