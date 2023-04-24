@extends('layouts.admin.admin')

@section('title', 'Create a Event')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('event.store')}}" method="POST" enctype="multipart/form-data">
            @include('event.form',['header' => 'Create a Event'])
            </form>
        </div>
    </section>
@endsection

