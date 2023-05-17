<?php

namespace Spatie\WordPressMailcoach\Tests\Admin\Action;

use Spatie\WordPressMailcoach\Admin\Action\GenerateShortcode;
use Spatie\WordPressMailcoach\Tests\TestCase;

class GenerateShortcodeTest extends TestCase
{
    /** @test */
    public function it_can_generate(): void
    {
        $title = 'Subscribe Form';

        $shortcode = (new GenerateShortcode())->execute($title);

        $this->assertSame('mailcoach-subscribe-form', $shortcode);
    }
}
