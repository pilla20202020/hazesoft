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

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Car" class="form-label">Car</label>
                                <select name="car_id" id="state_dropdown" class="form-control" required>
                                    <option value="#" selected disabled>Choose Car</option>
                                    @foreach ($cars as $car)
                                        <option value="{{$car->id}}" @if(isset($carmodel) && ($carmodel->car_id == $car->id)) selected @endif>{{$car->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($carmodel->name) ? $carmodel->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Title <span class="">*</span></label>
                                <div class="">
                                    <input class="form-control" type="text" required name="title" value="{{ old('title', isset($carmodel->title) ? $carmodel->title : '') }}" placeholder="Enter Title">
                                </div>
                            </div>
                            @error('title')
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @enderror

                        </div>
                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('carmodel.index') }}">
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
        $('#state_dropdown').select2();
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
