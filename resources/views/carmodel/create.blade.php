@extends('layouts.admin.admin')

@section('title', 'Create a Car Model')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('carmodel.store')}}" method="POST" enctype="multipart/form-data">
            @include('carmodel.form',['header' => 'Create a Car Model'])
            </form>
        </div>
    </section>
@endsection

