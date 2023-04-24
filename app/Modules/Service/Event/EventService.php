<?php

namespace App\Modules\Service\Event;

use App\Modules\Models\Event\Event;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EventService extends Service
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->event->get();

        $filter = (!empty($_GET["filter"])) ? ($_GET["filter"]) : ('');
        if (isset($filter)) {
            if ($filter == "finished") {
                $query = $this->event->where('end_date', '<', date('Y-m-d'))->get();
            }

            if ($filter == "upcoming") {
                $query = $this->event->where('start_date', '>', date('Y-m-d'))->get();
            }
            if($filter == "finished_7") {
                $date = Carbon::now()->subDays(7);
                $query = $this->event->whereBetween('end_date', [$date, date('Y-m-d')])->get();
            }

            if($filter == "upcoming_7") {
                $date = Carbon::now()->addDays(7);
                $query = $this->event->whereBetween('start_date', [date('Y-m-d'),$date])->get();
            }
        }

        return DataTables::of($query)
            ->addIndexColumn()

            ->editColumn('status', function (Event $event) {
                if ($event->start_date > date('Y-m-d')) {
                    return '<span class="badge badge-info">Upcoming</span>';
                } elseif ($event->end_date < date('Y-m-d')) {
                    return '<span class="badge badge-danger">Finished</span>';
                } else {
                    return '<span class="badge badge-warning">Happening Now</span>';
                }
            })

            ->editcolumn('actions', function (Event $event) {
                if ($event->start_date > date('Y-m-d')) {
                    $editRoute =  route('event.edit', $event->id);
                } else {
                    $editRoute = null;
                }
                $deleteRoute =  route('event.delete', $event->id);
                return getTableHtml($event, 'actions', $editRoute, $deleteRoute);
                return getTableHtml($event, 'image');
            })->rawColumns(['visibility', 'availability', 'status', 'image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $event = $this->event->create($data);
            return $event;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all Event
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;
        return $this->event->orderBy('start_date', 'desc')->paginate($filter['limit']);
    }

    /**
     * Get all Event
     *
     * @return Collection
     */
    public function all()
    {
        return $this->event->all();
    }

    /**
     * Get all Events with supervisor type
     *
     * @return Collection
     */


    public function find($eventId)
    {
        try {
            return $this->event->find($eventId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($eventId, array $data)
    {
        try {

            $event = $this->event->find($eventId);
            $event = $event->update($data);
            //$this->logger->info(' created successfully', $data);

            return $event;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a Event
     *
     * @param Id
     * @return bool
     */
    public function delete($eventId)
    {
        try {
            $event = $this->event->find($eventId);
            $event->delete();
        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * write brief description
     * @param $name
     * @return mixed
     */
}
