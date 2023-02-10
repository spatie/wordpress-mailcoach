<?php

namespace Tests\Admin;

use Spatie\WordPressMailcoach\Admin\Settings;

test('it can initialize a settings class', function (): void {
    $settings = Settings::make();

    $settings->initializeSettings();

    expect(true)->toBeTrue();
});
