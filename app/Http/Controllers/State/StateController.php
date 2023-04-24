<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller;
use App\Http\Requests\State\StateRequest;
use App\Modules\Service\state\stateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    protected $state;

    function __construct(StateService $state)
    {
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
        $state = $this->state->paginate();
        return view('state.index',compact('state'));
    }

    public function getAllData()
    {
        // dd($this->user);
        return $this->state->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        //
        if($state = $this->state->create($request->all())){
            Toastr()->success('State has been created successfully','Success');
            return redirect()->route('state.index');
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
        $state = $this->state->find($id);
        return view('state.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, $id)
    {
        //
        $input = $request->all();
        $state = $this->state->update($id, $input);
        Toastr()->success('State has been update successfully','Success');
        return redirect()->route('state.index');
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
        $state = $this->state->delete($id);
        return response()->json(['status'=>true]);
    }
}
