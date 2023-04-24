<?php

namespace App\Modules\Service\CarModel;

use App\Modules\Models\Carmodel\CarModel;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class CarModelService extends Service
{
    protected $carmodel;

    public function __construct(CarModel $carmodel)
    {
        $this->carmodel = $carmodel;

    }


    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->carmodel->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('car', function($query){
                return $query->car->title;
            })
            ->editcolumn('actions',function(CarModel $carmodel) {
                $deleteRoute = route('carmodel.destroy',$carmodel->id);
                $editRoute =  route('carmodel.edit',$carmodel->id);
                return getTableHtml($carmodel,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute = null);
            })->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['slug'] = Str::slug($data['title']);
            $carmodel = $this->carmodel->create($data);

            return $carmodel;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all carmodel
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->carmodel->orderBy('id','ASC')->get();
    }

    /**
     * Get all carmodel
     *
     * @return Collection
     */
    public function all()
    {
        return $this->carmodel->all();
    }

    /**
     * Get all carmodels with supervisor type
     *
     * @return Collection
     */


    public function find($carmodelId)
    {
        try {
            return $this->carmodel->find($carmodelId);

        } catch (Exception $e) {
            return null;
        }
    }


    public function update($carmodelId, array $data)
    {
        try {

            $carmodel = $this->carmodel->find($carmodelId);
            $data['slug'] = Str::slug($data['title']);
            $carmodel = $carmodel->update($data);

            return $carmodel;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a carmodel
     *
     * @param Id
     * @return bool
     */
    public function delete($carmodelId)
    {
        try {

            $carmodel = $this->carmodel->find($carmodelId);
            $carmodel->delete();

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
        return $this->carmodel->whereName($name);
    }

    public function getBySlug($id){
        return $this->carmodel->whereId($id)->first();
    }



}
