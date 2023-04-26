<?php

namespace Spatie\WordPressMailcoach\Admin\ValueObject;

use Spatie\WordPressMailcoach\Admin\Action\StoreSettings;
use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;

class Settings
{
    public const KEY_API_TOKEN = 'mailcoach_api_token';
    public const KEY_API_ENDPOINT = 'mailcoach_api_endpoint';

    private function __construct(
        private readonly string $apiToken,
        private readonly string $apiEndpoint,
    ) {
    }

    /** @return string[] */
    public static function keys(): array
    {
        return [
            self::KEY_API_TOKEN,
            self::KEY_API_ENDPOINT,
        ];
    }

    public static function make(): self
    {
        return new self(
            get_option(self::KEY_API_TOKEN),
            get_option(self::KEY_API_ENDPOINT),
        );
    }

    public function initialise(): void
    {
        $this::make();
    }

    public function apiToken(): string
    {
        return $this->apiToken;
    }

    public function apiEndpoint(): string
    {
        return $this->apiEndpoint . '/api';
    }

    public function store(StoreSettingsData $data): self
    {
        (new StoreSettings())->execute($data);

        return $this;
    }
}
