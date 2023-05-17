<?php

namespace Spatie\WordPressMailcoach\Tests\Admin\Action;

use RuntimeException;
use Spatie\WordPressMailcoach\Admin\Action\StoreSettings;
use Spatie\WordPressMailcoach\Admin\Data\StoreSettingsData;
use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Tests\TestCase;

class StoreSettingsTest extends TestCase
{
    /** @test */
    public function it_can_store_a_valid_api_and_endpoint(): void
    {
        $_POST['mailcoach_api_token'] = 'valid-token';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $storedApiToken = get_option(Settings::KEY_API_TOKEN);
        $storedApiEndpoint = get_option(Settings::KEY_API_ENDPOINT);

        $this->assertSame('valid-token', $storedApiToken);
        $this->assertSame('https://valid-endpoint.com', $storedApiEndpoint);
    }

    /** @test */
    public function it_can_update_the_api_token_and_endpoint(): void
    {
        $_POST['mailcoach_api_token'] = 'nWfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtAAAAA';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $_POST['mailcoach_api_token'] = 'nWfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtBBBBB';
        $_POST['mailcoach_api_endpoint'] = 'https://also-valid.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $storedApiToken = get_option(Settings::KEY_API_TOKEN);
        $storedApiEndpoint = get_option(Settings::KEY_API_ENDPOINT);

        $this->assertSame('nWfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtBBBBB', $storedApiToken);
        $this->assertSame('https://also-valid.com', $storedApiEndpoint);
    }

    /** @test */
    public function it_cannot_store_with_an_invalid_url(): void
    {
        $_POST['mailcoach_api_token'] = 'valid-token';
        $_POST['mailcoach_api_endpoint'] = 'invalid-url';

        $this->expectExceptionMessage('The given URL is not valid');
        $this->expectException(RuntimeException::class);

        $data = StoreSettingsData::fromRequest();
    }

    /** @test */
    public function it_will_not_update_the_key_when_last_4_chars_are_equal(): void
    {
        $_POST['mailcoach_api_token'] = $originalToken = 'nWfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtAAAAA';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $_POST['mailcoach_api_token'] = 'aaaaaaaaONffrrZ8drFqPVQB1gkv5mmptKtBAAAA';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $storedApiToken = get_option(Settings::KEY_API_TOKEN);

        $this->assertSame($originalToken, $storedApiToken);
    }

    /** @test */
    public function it_will_not_update_the_key_when_it_contains_an_asterix(): void
    {
        $_POST['mailcoach_api_token'] = $originalToken = 'nWfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtAAAAA';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $_POST['mailcoach_api_token'] = '*WfSjXAQONffrrZ8drFqPVQB1gkv5mmptKtBBBBB';
        $_POST['mailcoach_api_endpoint'] = 'https://valid-endpoint.com';

        $data = StoreSettingsData::fromRequest();

        $this->action()->execute($data);

        $storedApiToken = get_option(Settings::KEY_API_TOKEN);

        $this->assertSame($originalToken, $storedApiToken);
    }

    private function action(): StoreSettings
    {
        return new StoreSettings();
    }
}
