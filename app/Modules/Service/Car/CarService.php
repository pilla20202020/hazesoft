<?php

namespace App\Modules\Service\Car;

use App\Modules\Models\Car\Car;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class CarService extends Service
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;

    }


    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->car->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editcolumn('actions',function(car $car) {
                $deleteRoute = route('car.destroy',$car->id);
                $editRoute =  route('car.edit',$car->id);

                return getTableHtml($car,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute = null);
            })->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['slug'] = Str::slug($data['title']);
            $car = $this->car->create($data);

            return $car;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all car
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->car->orderBy('id','ASC')->get();
    }

    /**
     * Get all car
     *
     * @return Collection
     */
    public function all()
    {
        return $this->car->all();
    }

    /**
     * Get all cars with supervisor type
     *
     * @return Collection
     */


    public function find($carId)
    {
        try {
            return $this->car->find($carId);

        } catch (Exception $e) {
            return null;
        }
    }


    public function update($carId, array $data)
    {
        try {

            $car = $this->car->find($carId);
            $data['slug'] = Str::slug($data['title']);
            $car = $car->update($data);

            return $car;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a car
     *
     * @param Id
     * @return bool
     */
    public function delete($carId)
    {
        try {

            $car = $this->car->find($carId);
            $car->delete();

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
        return $this->car->whereName($name);
    }

    public function getBySlug($id){
        return $this->car->whereId($id)->first();
    }



}
