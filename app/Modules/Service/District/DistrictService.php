<?php

namespace App\Modules\Service\District;

use App\Modules\Models\District\District;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class DistrictService extends Service
{
    protected $district;

    public function __construct(District $district)
    {
        $this->district = $district;

    }


    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->district->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('state', function($query){
                return $query->state->title;
            })
            ->editcolumn('actions',function(district $district) {
                $deleteRoute = route('district.destroy',$district->id);
                $editRoute =  route('district.edit',$district->id);

                return getTableHtml($district,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute = null);
            })->make(true);
    }

    public function create(array $data)
    {
        try {

            $district = $this->district->create($data);

            return $district;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all district
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->district->orderBy('id','ASC')->get();
    }

    /**
     * Get all district
     *
     * @return Collection
     */
    public function all()
    {
        return $this->district->all();
    }

    /**
     * Get all districts with supervisor type
     *
     * @return Collection
     */


    public function find($districtId)
    {
        try {
            return $this->district->find($districtId);

        } catch (Exception $e) {
            return null;
        }
    }


    public function update($districtId, array $data)
    {
        try {

            $district = $this->district->find($districtId);
            $district = $district->update($data);

            return $district;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a district
     *
     * @param Id
     * @return bool
     */
    public function delete($districtId)
    {
        try {

            $district = $this->district->find($districtId);
            $district->delete();

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
        return $this->district->whereName($name);
    }

    public function getBySlug($id){
        return $this->district->whereId($id)->first();
    }



}
