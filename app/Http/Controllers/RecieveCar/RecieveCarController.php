<?php

namespace App\Http\Controllers\RecieveCar;

use App\Http\Controllers\Controller;
use App\Modules\Service\Car\CarService;
use App\Modules\Service\CarModel\CarModelService;
use App\Modules\Service\District\DistrictService;
use App\Modules\Service\RecieveCar\RecieveCarService;
use App\Modules\Service\State\StateService;
use App\Modules\Service\User\UserService;
use Illuminate\Http\Request;

class RecieveCarController extends Controller
{
    protected $district, $carmodel, $recieve_car, $user, $car, $state;

    function __construct(DistrictService $district, CarModelService $carmodel, RecieveCarService $recieve_car, UserService $user, CarService $car, StateService $state)
    {
        $this->district = $district;
        $this->carmodel = $carmodel;
        $this->recieve_car = $recieve_car;
        $this->user = $user;
        $this->car = $car;
        $this->state = $state;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recieve_car = $this->recieve_car->paginate();
        return view('recievecar.index',compact('recieve_car'));
    }


    public function getAllData()
    {
        // dd($this->user);
        return $this->recieve_car->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $districts = $this->district->paginate();
        $carmodels = $this->carmodel->paginate();
        $customers = $this->user->paginate();
        $cars = $this->car->paginate();
        $states = $this->state->paginate();
        return view('recievecar.create',compact('districts','carmodels','customers','cars','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
