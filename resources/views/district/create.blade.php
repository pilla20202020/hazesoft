@extends('layouts.admin.admin')

@section('title', 'Create a District')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('district.store')}}" method="POST" enctype="multipart/form-data">
            @include('district.form',['header' => 'Create a District'])
            </form>
        </div>
    </section>
@endsection

