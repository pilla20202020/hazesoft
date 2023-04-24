<?php

namespace Tests\Unit;

use App\Modules\Models\RecieveCar\RecieveCarModel;
use Tests\TestCase;


class RecieveCarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_recieve_car_store()
    {
        $response = $this->post(route('recieve-car.store'),[
            'customer_id' => '1',
            'carmodel_id' => '1',
            'customerlocation_id' => '2',
            'carlocation_id' => '4',
        ]);
        $response->assertStatus($response->status(), 200);


    }
}
