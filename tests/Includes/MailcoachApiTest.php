<?php

namespace Spatie\WordPressMailcoach\Tests\Includes;

use Spatie\WordPressMailcoach\Admin\ValueObject\Settings;
use Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateFormViewModel;
use Spatie\WordPressMailcoach\Includes\Api\MailcoachApi;
use Spatie\WordPressMailcoach\Tests\TestCase;

class MailcoachApiTest extends TestCase
{
    public function testEmailListsRemainUsableThroughTheBundledSdk(): void
    {
        $socket = stream_socket_server('tcp://127.0.0.1:0');
        $address = stream_socket_get_name($socket, false);
        fclose($socket);

        $log = tmpfile();
        $server = proc_open(
            [PHP_BINARY, '-S', $address, dirname(__DIR__) . '/fixtures/mailcoach-api.php'],
            [0 => ['pipe', 'r'], 1 => $log, 2 => $log],
            $pipes,
        );

        try {
            $ready = false;
            for ($attempt = 0; $attempt < 100; $attempt++) {
                $connection = @stream_socket_client('tcp://' . $address, $errorCode, $errorMessage, 0.1);
                if ($connection) {
                    fclose($connection);
                    $ready = true;
                    break;
                }

                usleep(10000);
            }
            $this->assertTrue($ready, 'The local Mailcoach API fixture did not start.');

            update_option(Settings::KEY_API_TOKEN, 'integration-token');
            update_option(Settings::KEY_API_ENDPOINT, 'http://' . $address);

            $api = MailcoachApi::fromSettings(Settings::make());
            $this->assertTrue($api->hasCredentials());

            $lists = $api->emailLists();
            $this->assertSame(2, $lists->total());
            $this->assertSame(1, $lists->currentPage());
            $this->assertNull($lists->next());
            $this->assertSame(['list-enabled', 'list-disabled'], array_map(fn ($list) => $list->uuid, iterator_to_array($lists)));
            $this->assertSame(34, $lists[0]->activeSubscribersCount);
            $this->assertSame(7, $lists[1]->activeSubscribersCount);
            $this->assertSame(['Newsletter', 'Customers'], array_map(fn ($list) => $list->name, $api->emailListOptions()));
            $this->assertSame(['Newsletter'], (new CreateOrUpdateFormViewModel($api))->enabledEmailListNames());

            $list = $api->emailList('list-disabled');
            $this->assertSame('list-disabled', $list->uuid);
            $this->assertSame('Customers', $list->name);
            $this->assertFalse($list->allowFormSubscriptions);
        } finally {
            proc_terminate($server);
            proc_close($server);
            fclose($log);
            delete_option(Settings::KEY_API_TOKEN);
            delete_option(Settings::KEY_API_ENDPOINT);
        }
    }
}
