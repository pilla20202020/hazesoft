<?php

namespace App\Modules\Service\RecieveCar;

use App\Modules\Models\District\District;
use App\Modules\Models\RecieveCar\RecieveCarModel;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class RecieveCarService extends Service
{
    protected $district, $recievecar;

    public function __construct(District $district, RecieveCarModel $recievecar)
    {
        $this->district = $district;
        $this->recievecar = $recievecar;

    }


    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->recievecar->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('customer', function($query){
                return ucfirst($query->customer->name);
            })
            ->addColumn('car_model', function($query){
                return  ucfirst($query->carModel->title);
            })

            ->addColumn('customer_location', function($query){
                return  ucfirst($query->customerLocation->title);
            })

            ->addColumn('car_location', function($query){
                return  ucfirst($query->carLocation->title);
            })
            ->editcolumn('actions',function(RecieveCarModel $recievecar) {
                $deleteRoute = route('recieve-car.destroy',$recievecar->id);
                $editRoute =  route('recieve-car.edit',$recievecar->id);

                return getTableHtml($recievecar,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute = null);
            })->make(true);
    }

    public function create(array $data)
    {
        try {

            $recievecar = $this->recievecar->create($data);
            return $recievecar;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all recievecar
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->recievecar->orderBy('id','ASC')->get();
    }

    /**
     * Get all recievecar
     *
     * @return Collection
     */
    public function all()
    {
        return $this->recievecar->all();
    }

    /**
     * Get all recievecars with supervisor type
     *
     * @return Collection
     */


    public function find($recievecarId)
    {
        try {
            return $this->recievecar->find($recievecarId);

        } catch (Exception $e) {
            return null;
        }
    }


    public function update($recievecarId, array $data)
    {
        try {

            $recievecar = $this->recievecar->find($recievecarId);
            $recievecar = $recievecar->update($data);

            return $recievecar;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a recievecar
     *
     * @param Id
     * @return bool
     */
    public function delete($recievecarId)
    {
        try {

            $recievecar = $this->recievecar->find($recievecarId);
            $recievecar->delete();

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
        return $this->recievecar->whereName($name);
    }

    public function getBySlug($id){
        return $this->recievecar->whereId($id)->first();
    }



}
