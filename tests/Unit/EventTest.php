<?php

namespace Tests\Unit;

use App\Modules\Models\Event\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    //  Test Event While Storing
    public function test_event_store()
    {
        $response = $this->call('POST','/event',[
            'title' => 'dasdasd',
            'start_date' => '2022-06-30',
            'end_date' => "2022-06-29",
        ]);
        $response->assertStatus($response->status(), 200);

    }

}
