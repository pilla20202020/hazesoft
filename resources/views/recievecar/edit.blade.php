@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('title','Recieve Car')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('recieve-car.update',$recievecar->id)}}"
                  method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('recievecar.form', ['header' => 'Edit recievecar <span class="text-primary">('.($recievecar->id).')</span>'])
            </form>
        </div>

        {{-- Add Customer --}}
        <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="name" class="col-form-label pt-0">Customer Name</label>
                                    <div class="">
                                        <input class="form-control store_customerName" name="name" type="text" required placeholder="Enter Customer Name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="name" class="col-form-label pt-0">Customer Email</label>
                                    <div class="">
                                        <input class="form-control store_customerEmail" name="email" type="email" required placeholder="Enter Customer Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-storeCustomer" data-dismiss="modal">Add Customer</button>
                    </div>
            </div>
            </div>
        </div>

        {{-- Add Car Model --}}
        <div class="modal fade" id="addCarModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Car Model</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="name" class="col-form-label pt-0">Choose Car</label>
                                    <select name="store_car_id" id="state_dropdown" class="form-control store_car_id" required>
                                        <option value="#" selected disabled>Choose Car</option>
                                        @foreach ($cars as $car)
                                            <option value="{{$car->id}}">{{$car->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('car_id'))
                                        <span class="text-danger">{{ $errors->first('car_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="name" class="col-form-label pt-0">Car Model Title</label>
                                    <div class="">
                                        <input class="form-control store_carModelName" name="title" type="text" required placeholder="Enter Car Model Name">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-storeCarModel" data-dismiss="modal">Add Car Model</button>
                    </div>
            </div>
            </div>
        </div>

        {{-- Add District --}}
        <div class="modal fade" id="addDistrict" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add District/Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="name" class="col-form-label pt-0">Choose State</label>
                                        <select name="store_state_id" id="state_dropdown" class="form-control store_state_id" required>
                                            <option value="#" selected disabled>Choose State</option>
                                            @foreach ($states as $state)
                                                <option value="{{$state->id}}">{{$state->title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state_id'))
                                            <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group ">
                                        <label for="name" class="col-form-label pt-0">District/Location Title</label>
                                        <div class="">
                                            <input class="form-control store_districtTitle" name="title" type="text" required placeholder="Enter District Title">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-storeDistirct" data-dismiss="modal">Add District/Location</button>
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

