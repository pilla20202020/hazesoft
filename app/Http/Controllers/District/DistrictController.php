<?php

namespace App\Http\Controllers\District;

use App\Http\Controllers\Controller;
use App\Http\Requests\District\DistrictRequest;
use App\Modules\Service\District\DistrictService;
use App\Modules\Service\State\StateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{

    protected $district, $state;

    function __construct(DistrictService $district, StateService $state)
    {
        $this->district = $district;
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
        $district = $this->district->paginate();
        return view('district.index',compact('district'));
    }

    public function getAllData()
    {
        // dd($this->user);
        return $this->district->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $states = $this->state->paginate();
        return view('district.create',compact('states'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        //
        if($district = $this->district->create($request->all())){
            Toastr()->success('District has been created successfully','Success');
            return redirect()->route('district.index');
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
        $district = $this->district->find($id);
        $states = $this->state->paginate();
        return view('district.edit',compact('district','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, $id)
    {
        //
        $input = $request->all();
        $district = $this->district->update($id, $input);
        Toastr()->success('District has been update successfully','Success');
        return redirect()->route('district.index');
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
        $district = $this->district->delete($id);
        return response()->json(['status'=>true]);
    }

    public function districtStore(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'state_id' => 'required|exists:states,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all(),
            ]);
        }
        if($district = $this->district->create($request->all())) {
            $district = $this->district->paginate();
            return response()->json([
                'data' => $district,
                'status' => true,
                'message' => "District Added Successfully."
            ]);
        }
    }
}
