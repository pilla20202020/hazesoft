@extends('layouts.admin.admin')

@section('title', 'Create a Car')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('car.store')}}" method="POST" enctype="multipart/form-data">
            @include('car.form',['header' => 'Create a Car'])
            </form>
        </div>
    </section>
@endsection

