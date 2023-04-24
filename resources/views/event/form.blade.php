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

                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($event->name) ? $event->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Title <span class="">*</span></label>
                                <div class="">
                                    <input class="form-control" type="text" required name="title" value="{{ old('title', isset($event->title) ? $event->title : '') }}" placeholder="Enter Title">
                                </div>
                            </div>
                            @error('title')
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @enderror

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="description" class="col-form-label pt-0">Description</label>
                                <div class="">
                                    <input class="form-control" type="text" name="description"
                                    value="{{ old('description', isset($event->description) ? $event->description : '') }}" placeholder="Enter Description">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="start_date" class="col-form-label pt-0">Start Date</label>
                                <div class="">
                                    <input class="form-control" type="date" name="start_date"
                                    value="{{ old('start_date', isset($event->start_date) ? $event->start_date : '') }}" min="{{date('Y-m-d')}}" required placeholder="Enter Start Date">
                                </div>
                            </div>
                            @error('start_date')
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @enderror
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="end_date" class="col-form-label pt-0">End Date</label>
                                <div class="">
                                    <input class="form-control" type="date" name="end_date"
                                    value="{{ old('end_date', isset($event->end_date) ? $event->end_date : '') }}" required min="{{date('Y-m-d')}}" placeholder="Enter End Date">
                                </div>
                            </div>
                            @error('end_date')
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @enderror
                        </div>

                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('event.index') }}">
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
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
