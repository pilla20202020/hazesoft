@extends('layouts.admin.admin')

@section('title', 'Create a User')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @include('user.form',['header' =>

            'Create a user'])
            </form>
        </div>
    </section>
@endsection


@section('page-specific-scripts')
<script src="{{ asset('backend/js/libs/dropify/dropify.min.js') }}"></script>

@endsection

