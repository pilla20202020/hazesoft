<?php

namespace App\Modules\Service\State;

use App\Modules\Models\State\State;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class StateService extends Service
{
    protected $state;

    public function __construct(State $state)
    {
        $this->state = $state;

    }


    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->state->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editcolumn('actions',function(State $state) {
                $deleteRoute = route('state.destroy',$state->id);
                $editRoute =  route('state.edit',$state->id);

                return getTableHtml($state,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute = null);
            })->make(true);
    }

    public function create(array $data)
    {
        try {

            $state = $this->state->create($data);

            return $state;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all state
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->state->orderBy('id','ASC')->get();
    }

    /**
     * Get all state
     *
     * @return Collection
     */
    public function all()
    {
        return $this->state->all();
    }

    /**
     * Get all states with supervisor type
     *
     * @return Collection
     */


    public function find($stateId)
    {
        try {
            return $this->state->find($stateId);

        } catch (Exception $e) {
            return null;
        }
    }


    public function update($stateId, array $data)
    {
        try {

            $state = $this->state->find($stateId);
            $state = $state->update($data);

            return $state;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a state
     *
     * @param Id
     * @return bool
     */
    public function delete($stateId)
    {
        try {

            $state = $this->state->find($stateId);
            $state->delete();

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name){
        return $this->state->whereName($name);
    }

    public function getBySlug($id){
        return $this->state->whereId($id)->first();
    }



}
