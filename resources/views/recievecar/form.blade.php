@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-11">
                            <div class="form-group">
                                <label for="Customer" class="form-label">Customer</label>
                                <select name="customer_id" id="customer" class="form-control select2 customer_class" required>
                                    <option value="#" selected disabled>Choose Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}" @if(isset($recievecar) && ($recievecar->customer_id == $customer->id)) selected @endif>{{ucfirst($customer->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1 p-0">
                            <div class="form-group ">
                                <label for="unit_id" class="col-form-label pt-4"></label>
                                <div class="">
                                    <a href="javascript:;" class="btn-addCustomer btn-twitter p-1">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-11">
                            <div class="form-group">
                                <label for="Car Model" class="form-label">Car Model</label>
                                <select name="carmodel_id" id="car_model" class="form-control select2 carmodel_class" required>
                                    <option value="#" selected disabled>Choose Car Model</option>
                                    @foreach ($carmodels as $carmodel)
                                        <option value="{{$carmodel->id}}" @if(isset($recievecar) && ($recievecar->carmodel_id == $carmodel->id)) selected @endif>{{$carmodel->car->title}} - {{ucfirst($carmodel->title)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1 p-0">
                            <div class="form-group ">
                                <label for="carmode" class="col-form-label pt-4"></label>
                                <div class="">
                                    <a href="javascript:;" class="btn-addCarModel btn-twitter p-1">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="Customer Location" class="form-label">Customer Location</label>
                                <select name="customerlocation_id" id="customerlocation" class="form-control select2" required>
                                    <option value="#" selected disabled>Choose Customer Location</option>
                                    @foreach ($districts as $customer_location)
                                        <option value="{{$customer_location->id}}" @if(isset($recievecar) && ($recievecar->customerlocation_id == $customer_location->id)) selected @endif>{{ucfirst($customer_location->title)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="Car Location" class="form-label">Car Location</label>
                                <select name="carlocation_id" id="carlocation" class="form-control select2" required>
                                    <option value="#" selected disabled>Choose Car Location</option>
                                    @foreach ($districts as $car_location)
                                        <option value="{{$car_location->id}}" @if(isset($recievecar) && ($recievecar->carlocation_id == $car_location->id)) selected @endif>{{ucfirst($car_location->title)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('district.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();

        $(document).ready(function () {
            $('.dropify').dropify();
        });
        // Add Customer
        $('.btn-addCustomer').click(function(e){
            e.preventDefault();
            $('#addCustomer').modal('show');
        });
        $('.btn-storeCustomer').click(function(e){
            e.preventDefault();
            var customer_name = $('.store_customerName').val();
            var customer_email = $('.store_customerEmail').val();
            $.ajax({

                url: "{{route('user.userStore')}}",
                type: "post",
                data: {
                    _token: $("meta[name='csrf-token']").attr('content'),
                    name: customer_name,
                    email: customer_email,
                },
                success:function(response){
                    if(typeof(response) != "object"){
                        response = JSON.parse(response);
                    }
                    var body = "";
                    if(response.data){
                        body += "<option value='' disabled selected>Choose Customer</option>";
                        $.each(response.data, function(key, names){
                            body += "<option value='"+names.id+"'>"+names.name+"</option>";
                        });
                        $('.customer_class').html(body);
                    }
                }
            })

        })


        // Add Car Model
        $('.btn-addCarModel').click(function(e){
            e.preventDefault();
            $('#addCarModel').modal('show');
        });
        $('.btn-storeCarModel').click(function(e){
            e.preventDefault();
            var car_id = $('.store_car_id').val();
            var car_model = $('.store_carModelName').val();
            $.ajax({

                url: "{{route('carmodel.carModelStore')}}",
                type: "post",
                data: {
                    _token: $("meta[name='csrf-token']").attr('content'),
                    title: car_model,
                    car_id: car_id,
                },
                success:function(response){
                    if(typeof(response) != "object"){
                        response = JSON.parse(response);
                    }
                    var body = "";
                    if(response.data){
                        body += "<option value='' disabled selected>Choose Car Model</option>";
                        $.each(response.data, function(key, names){
                            body += "<option value='"+names.id+"'>"+names.title+"</option>";
                        });
                        $('.carmodel_class').html(body);
                    }
                }
            })

        })





    </script>
@endsection
