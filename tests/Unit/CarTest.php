<?php

namespace Tests\Unit;

use Tests\TestCase;


class CarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_car_store()
    {
        $response = $this->post(route('car.store'),[
            'title' => 'BMW',
        ]);
        $response->assertStatus($response->status(), 200);

    }
}
