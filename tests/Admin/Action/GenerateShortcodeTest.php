<?php

namespace Spatie\WordPressMailcoach\Tests\Admin\Action;

use PHPUnit\Framework\TestCase;
use Spatie\WordPressMailcoach\Admin\Action\GenerateShortcode;

class GenerateShortcodeTest extends TestCase
{
    /** @test */
    public function it_can_generate(): void
    {
        //require_once 'wp/src/wp-includes/formatting.php';

        $title = 'Subscribe Form';

        $shortcode = (new GenerateShortcode())->execute($title);

        $this->assertSame('mailcoach-subscribe-form', $shortcode);
    }
}
