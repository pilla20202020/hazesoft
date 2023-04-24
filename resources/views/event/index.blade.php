@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Event')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Event</header>

                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction btn-sm" href="{{ route('event.create') }}">
                        <i class="md md-add"></i>
                        Add Event
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="from_date" class="col-form-label pt-0">Apply Filter</label>
                            <select name="filter" id="" class="select2 tail-select form-control filter" id="">
                                <option value="" disabled selected> -- Select Contition -- </option>
                                <option value="finished">Finished Events</option>
                                <option value="upcoming">Upcoming Events</option>
                                <option value="upcoming_7">Upcoming Events withing 7 days</option>
                                <option value="finished_7">Finished events of the last 7 days</option>
                            </select>
                            @error('filter')
                                <span class="text-danger">{{ $errors->first('filter') }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url" : "{{ route('event.data') }}",
                    data: function (d) {
                        d.filter = $('.filter').val();
                    }
                },
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print',
                //     // exportOptions: {
                //     //     columns: 'th:not(:last-child)'
                //     // }
                // ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Export Search Results',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                ],
                "lengthMenu": [ 10, 25, 50, 75, 100 ],
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: false, searchable: false },
                    { "data": "title" },
                    { "data": "description" },
                    { "data": "start_date" },
                    { "data": "end_date" },
                    { "data": "status" },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [[4, 'asc'] ]
            });

            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var currentObj = $(this);
                var route = $(this).data('route');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // var delete_id = $(this).attr("data-id").split('~');
                        // var currentID = $(this).parent().parent();
                        $.ajax({
                            type: "get",
                            url: route,

                            dataType: "json",
                            success: (data) => {
                                if (data.status) {
                                    currentObj.parent().parent().parent().hide();
                                } else {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                        footer: ''
                                    })
                                }
                            }
                        })
                    }
                })
            });

            $('.select2').select2({
                containerCssClass: function(e) {
                    return $(e).attr('required') ? 'required' : '';
                }
            });

            $('.filter').change(function(){
                $('#datatable').DataTable().draw(true);
            });
        } );
    </script>


@endsection


