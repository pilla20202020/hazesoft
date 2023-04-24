<?php

namespace App\Http\Controllers\CarModel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarModel\CarModelRequest;
use App\Modules\Service\Car\CarService;
use App\Modules\Service\CarModel\CarModelService;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    protected $carmodel, $car;

    function __construct(CarModelService $carmodel, CarService $car)
    {
        $this->carmodel = $carmodel;
        $this->car = $car;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carmodel = $this->carmodel->paginate();
        return view('carmodel.index',compact('carmodel'));
    }

    public function getAllData()
    {
        // dd($this->user);
        return $this->carmodel->getAllData();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cars = $this->car->paginate();
        return view('carmodel.create',compact('cars'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelRequest $request)
    {
        //
        if($carmodel = $this->carmodel->create($request->all())){
            Toastr()->success('Car Models has been created successfully','Success');
            return redirect()->route('carmodel.index');
        }
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
        $carmodel = $this->carmodel->find($id);
        $cars = $this->car->paginate();
        return view('carmodel.edit',compact('carmodel','cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelRequest $request, $id)
    {
        //
        $input = $request->all();
        $carmodel = $this->carmodel->update($id, $input);
        Toastr()->success('Car Model has been update successfully','Success');
        return redirect()->route('carmodel.index');
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

        $carmodel = $this->carmodel->delete($id);
        return response()->json(['status'=>true]);
    }

    public function carModelStore(Request $request) {

        if($carmodel = $this->carmodel->create($request->all())) {
            $carmodel = $this->carmodel->paginate();
            return response()->json([
                'data' => $carmodel,
                'status' => true,
                'message' => "Car Model Added Successfully."
            ]);
        }
    }
}
