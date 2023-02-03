<?php

/**
 * Taken from the original Pest repo
 *
 * @licence MITgs
 *
 * @link https://github.com/pestphp/pest/blob/master/stubs/init/ExampleTest.php
 */

test('example', function () {
    expect(true)->toBeTrue();
});

test('submitting valid api settings', function () {
    $settings = \Spatie\WordPressMailcoach\Admin\Settings::make();
    var_dump($settings);
});
