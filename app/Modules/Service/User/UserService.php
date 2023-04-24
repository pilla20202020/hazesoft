<?php

namespace App\Modules\Service\User;

use App\Modules\Models\User;
use App\Modules\Models\UserDetail\UserDetail;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class UserService extends Service
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->user->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            // ->editColumn('user',function(user $user) {
            //     if($user->user->name) {
            //         return $user->user->name;
            //     }
            // })
            // ->editColumn('category',function(user $user) {
            //     if($user->category->name) {
            //         return $user->category->name;
            //     }
            // })
            ->editColumn('visibility',function(user $user) {
                if($user->visibility == 'visible'){
                    return '<span class="badge badge-info">Visible</span>';
                } else {
                    return '<span class="badge badge-danger">In-Visible</span>';
                }
            })
            ->editColumn('availability',function(user $user) {
                if($user->availability == 'available'){
                    return '<span class="badge badge-info">Available</span>';
                } else {
                    return '<span class="badge badge-danger">Un-Available</span>';
                }
            })
            ->editColumn('status',function(user $user) {
                if($user->status == 'active'){
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->editColumn('image',function(user $user) {
                if(isset($user->image_path)){
                    return '<img src="http://127.0.0.1:8000/'.($user->image_path).'" width="100px">';
                } else {
                    ;
                }
            })

            ->editcolumn('actions',function(user $user) {
                $deleteRoute = route('user.destroy',$user->id);
                $editRoute =  route('user.edit',$user->id);
                $viewRoute =  route('user.show',$user->id);
                return getTableHtml($user,'actions',$editRoute,$deleteRoute,$printRoute = null,$viewRoute);
                return getTableHtml($user,'image');
            })->rawColumns(['visibility','availability','status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
            // dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['remember_token'] = Str::random(12);
            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            // $data['created_by']= Auth::user()->id;
            if(isset($data['password']))
            {
                $data['password'] = Hash::make($data['password']);
            } else {
                $data['password'] = Hash::make("password");

            }


            $user = $this->user->create($data);

            return $user;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {

        return $this->user->orderBy('id','ASC')->whereIsDeleted('no')->get();
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->user->whereIsDeleted('no')->all();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($userId)
    {
        try {
            return $this->user->whereIsDeleted('no')->where('id',$userId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($userId, array $data)
    {
        try {

            $input['name'] = $data['name'];
            $input['email'] = $data['email'];
            $input['phone'] = $data['phone'];
            $input['citizenship_number'] = $data['citizenship_number'];
            $input['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $input['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $input['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            // $input['has_subuser'] = (isset($data['has_subuser']) ?  $data['has_subuser'] : '')=='on' ? 'yes' : 'no';
            // $input['last_updated_by']= Auth::user()->id;
            $user= $this->user->find($userId);

            $user = $user->update($input);
            //$this->logger->info(' created successfully', $data);




            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a User
     *
     * @param Id
     * @return bool
     */
    public function delete($userId)
    {
        try {

            $user = $this->user->find($userId);
            $user->delete();

        } catch (Exception $e) {
            return false;
        }
    }

    public function getUserRoles($id){
        try{
            $user = User::with('roles')->find($id);
            $roles = $user->roles;
            return $roles;
        }catch (Exception $e){
            return false;
        }
    }


    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name){
        return $this->user->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($id){
        return $this->user->whereIsDeleted('no')->whereId($id)->first();
    }




    public function profileUpdate(array $data, $userId)
    {
        try {
            $data['email'] = $data['email'];
            $data['password'] = Hash::make($data['password']);
            $data['last_updated_by']= Auth::user()->id;
            $user= $this->user->find($userId);
            $user = $user->update($data);
            //$this->logger->info(' created successfully', $data);

            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function passwordUpdate(array $data)
    {
        try {
            $user= $this->user->where('email',$data['email'])->first();
            if(isset($user)) {
                $data['password'] = Hash::make($data['password']);
                $data['remember_token'] = Str::random(12);
                $user = $user->update($data);
            } else {
                Toastr()->error('The requested email does not exist','Sorry');
                return false;
            }
            //$this->logger->info(' created successfully', $data);

            return true;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }


    public function findByToken($token)
    {
        try {
            $user= $this->user->where('remember_token',$token)->first();
            //$this->logger->info(' created successfully', $data);
            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }



}
