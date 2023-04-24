@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('title',$user->name)

@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-underline">
                            
                            <div class="card-body">
            
                                <div class="row">
                                    <div class="col-sm-6">
            
                                        <div class="form-group ">
                                            <label for="name" class="col-form-label pt-0">Name</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="name" value="{{ old('name', isset($user->name) ? $user->name : '') }}" placeholder="Enter Your Name" readonly>
                                                @error('name')
                                                    <span class="text text-danger">{{$message}}*</span>
                                                @enderror
                                            </div>
                                        </div>
            
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Email</label>
                                            <div class="">
                                                <input class="form-control" type="email" name="email" data-role="tagsinput"
                                                value="{{ old('email', isset($user->email) ? $user->email : '') }}" placeholder="Enter a email" required readonly>
                                                @error('email')
                                                    <span class="text text-danger">{{$message}}*</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                
            
                        
            
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Phone </label>
                                            <div class="">
                                                <input class="form-control" type="number" name="phone" data-role="tagsinput"
                                                value="{{ old('phone', isset($user->phone) ? $user->phone : '') }}" placeholder="Enter a Phone" required readonly>
                                            </div>
                                            @error('phone')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="citizenship_number" class="col-form-label pt-0">CitizenShip Number </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="citizenship_number" data-role="tagsinput"
                                                value="{{ old('citizenship_number', isset($user->citizenship_number) ? $user->citizenship_number : '') }}" placeholder="Enter a Phone" readonly>
                                            </div>
                                            @error('citizenship_number')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                
                
                                {{-- @if(Auth::user()->hasRole('Staff'))
                                    <input type="hidden" name="roles[]" value="Student">
                                @else
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="user" class="col-form-label pt-0">Choose a role</label>
                                                    <div class="">
                                                        <select data-placeholder="Select Roles" class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple">
                                                            @foreach($roles as $role_data)
                                                                @if(isset($userRoles))
                                                                    @foreach($userRoles as $user_role)
                                                                        <option value="{{$role_data->id}}" @if($user_role->id==$role_data->id) selected @endif>{{ucfirst($role_data->name)}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{$role_data->id}}">{{ucfirst($role_data->name)}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('roles')
                                                            <span class="text text-danger">{{$message}}*</span>
                                                        @enderror
                                                    </div>    
                                            
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
            
                                <div class="row" id="imageupload">
                                    @if(!empty($user->image))
                                        <div class="col-sm-12">
                                            <label class="text-default-light">User Image</label>
                                            @if(isset($user) && $user->image)
                                                <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->image) }}">
                                            
                                            @endif
                                            
                                        </div>
                                    @endif
                
                                </div>
            
                                @if(!empty($user->userDetail))
                                <h4 class="mt-3">User Detail</h4>
                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Current Address </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="current_address" data-role="tagsinput"
                                                value="{{ old('current_address', isset($user->userDetail->current_address) ? $user->userDetail->current_address : '') }}" placeholder="Enter Current Address" readonly>
                                            </div>
                                            @error('current_address')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Permanent Address </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="permanent_address" data-role="tagsinput"
                                                value="{{ old('permanent_address', isset($user->userDetail->permanent_address) ? $user->userDetail->permanent_address : '') }}" placeholder="Enter Permanent Address" readonly>
                                            </div>
                                            @error('permanent_address')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Father Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="father_name" data-role="tagsinput"
                                                value="{{ old('father_name', isset($user->userDetail->father_name) ? $user->userDetail->father_name : '') }}" placeholder="Enter Father Name" required readonly>
                                            </div>
                                            @error('father_name')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Mother Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="mother_name" data-role="tagsinput"
                                                value="{{ old('mother_name', isset($user->userDetail->mother_name) ? $user->userDetail->mother_name : '') }}" placeholder="Enter Mother Name" required readonly>
                                            </div>
                                            @error('mother_name')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Spouse Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="spouse_name" data-role="tagsinput"
                                                value="{{ old('spouse_name', isset($user->userDetail->spouse_name) ? $user->userDetail->spouse_name : '') }}" placeholder="Enter Spouse Name" readonly>
                                            </div>
                                            @error('father_name')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
            
                                <h4 class="mt-3">Nominee Detail</h4>
                                <div class="row mt-3">
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Nominee Name </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="nominee_name" data-role="tagsinput"
                                                value="{{ old('nominee_name', isset($user->userDetail->nominee_name) ? $user->userDetail->nominee_name : '') }}" placeholder="Enter Nominee Name" readonly>
                                            </div>
                                            @error('nominee_name')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Nominee Relation </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="nominee_relation" data-role="tagsinput"
                                                value="{{ old('nominee_relation', isset($user->userDetail->nominee_relation) ? $user->userDetail->nominee_relation : '') }}" placeholder="Enter Nominee Relation" readonly>
                                            </div>
                                            @error('nominee_relation')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Nominee Contact Number </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="nominee_contact_number" data-role="tagsinput"
                                                value="{{ old('nominee_contact_number', isset($user->userDetail->nominee_contact_number) ? $user->userDetail->nominee_contact_number : '') }}" placeholder="Enter Nominee Contact Number" required>
                                            </div>
                                            @error('nominee_contact_number')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label for="specialization" class="col-form-label pt-0">Nominee Citizenship Number </label>
                                            <div class="">
                                                <input class="form-control" type="text" name="nominee_citizenship_number" data-role="tagsinput"
                                                value="{{ old('nominee_citizenship_number', isset($user->userDetail->nominee_citizenship_number) ? $user->userDetail->nominee_citizenship_number : '') }}" placeholder="Enter Current Address" readonly>

                                            </div>
                                            @error('nominee_citizenship_number')
                                                <span class="text text-danger">{{$message}}*</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
            
                                <h4 class="mt-3">File Documents</h4>
                                <div class="row mt-3">
                                    @if(!empty($user->userDetail->citizenship))
                                        <div class="col-sm-6">
                                            <label class="text-default-light">Citizen Ship</label><br>
                                            <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->userDetail->citizenship) }}">
                                        </div>
                                    @endif
            
                                    @if(!empty($user->userDetail->signature))
                                        <div class="col-sm-6">
                                            <label class="text-default-light">Signature</label>
                                            
                                            <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->userDetail->signature) }}">

                                            
                                        </div>
                                    @endif
            
                                    @if(!empty($user->userDetail->thumb))
                                        <div class="col-sm-6">
                                            <label class="text-default-light">Thumb</label>
                                    
                                            <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->userDetail->thumb) }}">

                                            
                                        </div>
                                    @endif
            
                                    @if(!empty($user->userDetail->nominee_citizen))
                                        <div class="col-sm-6">
                                            <label class="text-default-light">Nominee CitizenShip</label>
                                    
                                            <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->userDetail->nominee_citizen) }}">
                                            
                                            
                                        </div>
                                    @endif
            
                                    @if(!empty($user->userDetail->nominee_photo))
                                        <div class="col-sm-6">
                                            <label class="text-default-light">Nominee Photo</label>
                                        
                                            <img id="holder" style="margin-top:15px;max-height:200px;" class="img img-fluid" src="{{ asset('storage/' . $user->userDetail->nominee_photo) }}">
                                            
                                            
                                        </div>
                                    @endif
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('page-specific-scripts')
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection

